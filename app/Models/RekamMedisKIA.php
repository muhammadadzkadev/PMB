<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisKIA extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_kias';

    protected $fillable = [
        'pendaftaran_id',
        'tanggal',
        'td',
        'bb',
        'tfu',
        'lila',
        'lingkar_perut',
        'letak_janin',
        'djj',
        'keluhan',
        'analisis',
        'penatalaksanaan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'bb' => 'decimal:2',
        'uk' => 'integer',
        'tfu' => 'decimal:2',
        'lila' => 'decimal:2',
        'lingkar_perut' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
