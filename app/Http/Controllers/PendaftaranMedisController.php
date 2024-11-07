<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranMedis;
use App\Models\Patient;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PendaftaranMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranMedis::with(['patient', 'poli']);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_daftar', $request->tanggal);
        }

        if ($request->filled('poli_id')) {
            $query->where('poli_id', $request->poli_id);
        }

        if ($request->filled('status')) {
            $status = $request->status == '1';
            if ($status) {
                $query->where(function($q) {
                    $q->has('rekamMedisAnak')
                      ->orHas('rekamMedisKIA')
                      ->orHas('rekamMedisKB');
                });
            } else {
                $query->doesntHave('rekamMedisAnak')
                      ->doesntHave('rekamMedisKIA')
                      ->doesntHave('rekamMedisKB');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $query->orderByRaw("
            CASE 
                WHEN (SELECT COUNT(*) FROM rekam_medis_anaks WHERE rekam_medis_anaks.pendaftaran_id = pendaftaran_medis.id) > 0 THEN 1
                WHEN (SELECT COUNT(*) FROM rekam_medis_kias WHERE rekam_medis_kias.pendaftaran_id = pendaftaran_medis.id) > 0 THEN 1
                WHEN (SELECT COUNT(*) FROM rekam_medis_kbs WHERE rekam_medis_kbs.pendaftaran_id = pendaftaran_medis.id) > 0 THEN 1
                ELSE 0
            END ASC,
            tanggal_daftar DESC
        ");

        $pendaftaranMedis = $query->get();
        $polis = Poli::all();

        return view('pelayanan-medis.index', compact('pendaftaranMedis', 'polis'));
    }

    public function createPendaftaran($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $polis = Poli::all();
        return view('pendaftaran.create-pendaftaran', compact('patient', 'polis'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'tanggal_daftar' => 'required|date',
                'jenis_kunjungan' => 'required|in:Baru,Lama',
                'poli_id' => 'required|exists:poli,id',
                'status_hamil' => 'required|in:Ya,Tidak',
            ]);

            $pendaftaranMedis = PendaftaranMedis::create($validatedData);

            if (!$pendaftaranMedis) {
                throw new \Exception('Gagal membuat PendaftaranMedis');
            }

            return redirect()->route('pelayanan-medis.index')->with('success', 'Pendaftaran berhasil disimpan');
        } catch (\Exception $e) {
            Log::error('Error dalam pembuatan PendaftaranMedis: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pendaftaran: ' . $e->getMessage())->withInput();
        }
    }
}