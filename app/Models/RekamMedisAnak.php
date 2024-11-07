<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisAnak extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_anaks';
    
    protected $fillable = [
        'pendaftaran_id',
        'tanggal',
        'keluhan',
        'hasil_pemeriksaan',
        'analisa',
        'penatalaksanaan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
