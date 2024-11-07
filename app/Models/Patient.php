<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_dokumen_rm',
        'penjamin',
        'golongan_darah',
        'no_kk',
        'email',
        'nik',
        'no_hp',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat',
        'rt',
        'rw',
        'pekerjaan',
        'pekerjaan_suami',
        'instansi',
        'agama',
        'pendidikan',
        'status_perkawinan',
    ];

    public function pendaftaranMedis()
    {
        return $this->hasMany(PendaftaranMedis::class);
    }
}