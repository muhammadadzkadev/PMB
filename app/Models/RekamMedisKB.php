<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisKB extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_kbs';
    
    protected $fillable = [
        'pendaftaran_id',
        'tanggal',
        'hari_terakhir_haid',
        'keluhan',
        'pemeriksaan',
        'analisa_diagnosa',
        'tindakan',
        'kunjungan_ulang'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'hari_terakhir_haid' => 'date',
        'kunjungan_ulang' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
