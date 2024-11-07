<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesaKB extends Model
{
    use HasFactory;

    protected $table = 'anamnesa_kb';

    protected $fillable = [
        'pendaftaran_id', 
        'jumlah_anak', 
        'anak_terakhir', 
        'riwayat_kb_terakhir'
    ];

    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
