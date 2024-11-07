<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesaKIA extends Model
{
    use HasFactory;

    protected $table = 'anamnesa_kia';

    protected $fillable = [
        'pendaftaran_id',
        'hpht',
        'g',
        'p',
        'a',
        'jarak_persalinan',
        'cara_persalinan',
        'riwayat_kb_terakhir',
        'tb',
    ];

    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
