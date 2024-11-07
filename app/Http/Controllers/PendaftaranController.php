<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function pasienKK(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
        })->get();

        return view('pendaftaran.pasien-kk', compact('patients'));
    }

    public function createPasien()
    {
        return view('pendaftaran.create-pasien');
    }

    public function storePasien(Request $request)
    {
        $validatedData = $request->validate([
            'penjamin' => 'required',
            'golongan_darah' => 'nullable',
            'no_kk' => 'required',
            'email' => 'nullable|email',
            'nik' => 'required|unique:patients',
            'no_hp' => 'nullable',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'alamat_ktp_berbeda' => 'boolean',
            'pekerjaan' => 'nullable',
            'pekerjaan_suami' => 'nullable',
            'instansi' => 'nullable',
            'agama' => 'required',
            'pendidikan' => 'required',
            'status_perkawinan' => 'required',
        ]);

        $tanggal_lahir = \Carbon\Carbon::parse($validatedData['tanggal_lahir'])->format('dmY');
        $random_letters = strtoupper(Str::random(4));
        $validatedData['no_dokumen_rm'] = "RM-{$tanggal_lahir}-{$random_letters}";

        Patient::create($validatedData);

        return redirect()->route('pendaftaran.pasien-kk')->with('success', 'Data pasien berhasil disimpan');
    }
}