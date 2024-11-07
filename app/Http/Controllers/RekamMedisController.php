<?php

namespace App\Http\Controllers;

use App\Models\AnamnesaAnak;
use App\Models\AnamnesaKB;
use App\Models\AnamnesaKIA;
use App\Models\Patient;
use App\Models\PendaftaranMedis;
use App\Models\Poli;
use App\Models\RekamMedisKB;
use App\Models\RekamMedisKIA;
use App\Models\RekamMedisAnak;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nik', 'like', "%{$search}%");
        })->paginate(10);

        if ($search) {
            $patients->appends(['search' => $search]);
        }

        return view('rekam-medis.index', compact('patients'));
    }

    public function show(Patient $patient)
    {
        $birthDate = Carbon::parse($patient->tanggal_lahir);
        $now = Carbon::now();
        
        $age = [
            'years' => $birthDate->diffInYears($now),
            'months' => $birthDate->copy()->addYears($birthDate->diffInYears($now))->diffInMonths($now)
        ];

        $anakRecords = RekamMedisAnak::whereHas('pendaftaranMedis', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })->get();

        $kbRecords = RekamMedisKB::whereHas('pendaftaranMedis', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })->get();

        $kiaRecords = RekamMedisKIA::whereHas('pendaftaranMedis', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })->get();

        return view('rekam-medis.show', compact('patient', 'age', 'anakRecords', 'kbRecords', 'kiaRecords'));
    }

    public function export(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        
        $query = PendaftaranMedis::where('patient_id', $patientId);

        if ($request->has('poli') && !empty($request->poli)) {
            $query->whereIn('poli_id', $request->poli);
        }

        if ($request->date_range && $request->date_range !== 'all') {
            $days = (int) $request->date_range;
            $query->where('tanggal_daftar', '>=', Carbon::now()->subDays($days));
        }

        $pendaftaranList = $query->orderBy('tanggal_daftar', 'desc')->get();
        
        $data = [
            'patient' => $patient,
            'rekamMedisData' => [],
            'filters' => [
                'date_range' => $request->date_range,
                'poli' => $request->poli ?? []
            ]
        ];

        foreach ($pendaftaranList as $pendaftaran) {
            $rekamMedisEntry = [
                'tanggal_daftar' => $pendaftaran->tanggal_daftar,
                'jenis_kunjungan' => $pendaftaran->jenis_kunjungan,
                'poli' => $pendaftaran->poli->nama_poli,
                'records' => []
            ];

            switch ($pendaftaran->poli_id) {
                case 1: // Anak
                    $rekamMedis = $pendaftaran->rekamMedisAnak()->with('pendaftaranMedis.anamnesaAnak')->get();
                    foreach ($rekamMedis as $record) {
                        $anamnesa = $pendaftaran->anamnesaAnak()->first();
                        $rekamMedisEntry['records'][] = [
                            'type' => 'Anak',
                            'rekam_medis' => $record,
                            'anamnesa' => $anamnesa
                        ];
                    }
                    break;

                case 2: // KIA
                    $rekamMedis = $pendaftaran->rekamMedisKIA()->with('pendaftaranMedis.anamnesaKIA')->get();
                    foreach ($rekamMedis as $record) {
                        $anamnesa = $pendaftaran->anamnesaKIA()->first();
                        $rekamMedisEntry['records'][] = [
                            'type' => 'KIA',
                            'rekam_medis' => $record,
                            'anamnesa' => $anamnesa
                        ];
                    }
                    break;

                case 3: // KB
                    $rekamMedis = $pendaftaran->rekamMedisKB()->with('pendaftaranMedis.anamnesaKB')->get();
                    foreach ($rekamMedis as $record) {
                        $anamnesa = $pendaftaran->anamnesaKB()->first();
                        $rekamMedisEntry['records'][] = [
                            'type' => 'KB',
                            'rekam_medis' => $record,
                            'anamnesa' => $anamnesa
                        ];
                    }
                    break;
            }

            if (!empty($rekamMedisEntry['records'])) {
                $data['rekamMedisData'][] = $rekamMedisEntry;
            }
        }

        $pdf = Pdf::loadView('rekam-medis.pdf.export', $data);
        
        return $pdf->download('rekam-medis-' . $patient->nama . '.pdf');
    }

    public function input(PendaftaranMedis $pendaftaran, Poli $poli)
    {
        switch ($poli->id) {
            case 1:
                return redirect()->route('rekam-medis.kia.input', $pendaftaran);
            case 2:
                return redirect()->route('rekam-medis.kb.input', $pendaftaran);
            case 3:
                return redirect()->route('rekam-medis.anak.input', $pendaftaran);
            default:
                return redirect()->back()->with('error', 'Poli tidak ditemukan');
        }
    }

    public function inputKIA(PendaftaranMedis $pendaftaran)
    {
        return view('rekam-medis.kia.input', compact('pendaftaran'));
    }

    public function inputKB(PendaftaranMedis $pendaftaran)
    {
        return view('rekam-medis.kb.input', compact('pendaftaran'));
    }

    public function inputAnak(PendaftaranMedis $pendaftaran)
    {
        return view('rekam-medis.anak.input', compact('pendaftaran'));
    }

    public function create(PendaftaranMedis $pendaftaran)
    {
        return view('rekam-medis.create', compact('pendaftaran'));
    }

    public function storeAnak(Request $request, PendaftaranMedis $pendaftaran)
    {
        try {
            DB::beginTransaction();

            $validatedAnakData = $request->validate([
                'tanggal' => 'required|date',
                'keluhan' => 'required|string',
                'hasil_pemeriksaan' => 'required|string',
                'analisa' => 'required|string',
                'penatalaksanaan' => 'required|string',
            ]);

            $rekamMedisAnak = new RekamMedisAnak($validatedAnakData);
            $rekamMedisAnak->pendaftaran_id = $pendaftaran->id;
            $rekamMedisAnak->save();

            $this->storeAnamnesaAnak($request, $pendaftaran->id);

            DB::commit();

            return response()->json([
                'message' => 'Data Rekam Medis Anak dan Anamnesa berhasil disimpan.'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    private function storeAnamnesaAnak(Request $request, $pendaftaranId)
    {
        $validatedAnamnesaData = $request->validate([
            'riwayat_imunisasi' => 'required|string',
            'riwayat_penyakit' => 'required|string',
        ]);

        $validatedAnamnesaData['pendaftaran_id'] = $pendaftaranId;
        
        return AnamnesaAnak::create($validatedAnamnesaData);
    }

    public function storeKIA(Request $request, PendaftaranMedis $pendaftaran)
    {
        try {
            DB::beginTransaction();

            $validatedKIAData = $request->validate([
                'tanggal' => 'required|date',
                'keluhan' => 'required|string',
                'td' => 'required|string',
                'bb' => 'required|numeric',
                'tfu' => 'required|numeric',
                'lila' => 'required|numeric',
                'lingkar_perut' => 'required|numeric',
                'letak_janin' => 'required|string',
                'djj' => 'required|string',
                'analisis' => 'required|string',
                'penatalaksanaan' => 'required|string',
            ]);

            $rekamMedisKIA = new RekamMedisKIA($validatedKIAData);
            $rekamMedisKIA->pendaftaran_id = $pendaftaran->id;
            $rekamMedisKIA->save();

            $this->storeAnamnesaKIA($request, $pendaftaran->id);

            DB::commit();

            return response()->json(['message' => 'Data KIA dan Anamnesa berhasil disimpan.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data KIA: ' . $e->getMessage()], 500);
        }
    }

    public function getAnamnesaAnak($id)
    {
        $rekamMedis = RekamMedisAnak::findOrFail($id);
        $anamnesa = AnamnesaAnak::where('pendaftaran_id', $rekamMedis->pendaftaran_id)->first();

        if (!$anamnesa) {
            return response()->json(['error' => 'Anamnesa tidak ditemukan'], 404);
        }

        return response()->json($anamnesa);
    }

    private function storeAnamnesaKIA(Request $request, $pendaftaranId)
    {
        $validatedAnamnesaData = $request->validate([
            'hpht' => 'required|date',
            'g' => 'required|integer',
            'p' => 'required|integer',
            'a' => 'required|integer',
            'jarak_persalinan' => 'required|string',
            'cara_persalinan' => 'required|string',
            'riwayat_kb_terakhir' => 'required|string',
            'tb' => 'required|numeric',
        ]);

        $validatedAnamnesaData['pendaftaran_id'] = $pendaftaranId;
        
        return AnamnesaKIA::create($validatedAnamnesaData);
    }

    public function getAnamnesaKIA($id)
    {
        $rekamMedis = RekamMedisKIA::findOrFail($id);
        $anamnesa = AnamnesaKIA::where('pendaftaran_id', $rekamMedis->pendaftaran_id)->first();

        if (!$anamnesa) {
            return response()->json(['error' => 'Anamnesa tidak ditemukan'], 404);
        }

        return response()->json($anamnesa);
    }

    public function storeKB(Request $request, PendaftaranMedis $pendaftaran)
    {
        try {
            DB::beginTransaction();
    
            $validatedKBData = $request->validate([
                'tanggal' => 'required|date',
                'hari_terakhir_haid' => 'required|date',
                'keluhan' => 'required|string',
                'pemeriksaan' => 'required|string',
                'analisa_diagnosa' => 'required|string',
                'tindakan' => 'required|string',
                'kunjungan_ulang' => 'required|date',
            ]);
    
            $rekamMedisKB = new RekamMedisKB($validatedKBData);
            $rekamMedisKB->pendaftaran_id = $pendaftaran->id;
            $rekamMedisKB->save();
    
            $this->storeAnamnesaKB($request, $pendaftaran->id);
    
            DB::commit();
    
            return response()->json(['message' => 'Data KB dan Anamnesa berhasil disimpan.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data KB: ' . $e->getMessage()], 500);
        }
    }
    
    private function storeAnamnesaKB(Request $request, $pendaftaranId)
    {
        $validatedAnamnesaData = $request->validate([
            'jumlah_anak' => 'required|integer',
            'anak_terakhir' => 'required|string',
            'riwayat_kb_terakhir' => 'required|string',
        ]);
    
        $validatedAnamnesaData['pendaftaran_id'] = $pendaftaranId;
        
        return AnamnesaKB::create($validatedAnamnesaData);
    }

    public function getAnamnesaKB($id)
    {
        $rekamMedis = RekamMedisKB::findOrFail($id);
        $anamnesa = AnamnesaKB::where('pendaftaran_id', $rekamMedis->pendaftaran_id)->first();

        if (!$anamnesa) {
            return response()->json(['error' => 'Anamnesa tidak ditemukan'], 404);
        }

        return response()->json($anamnesa);
    }

}