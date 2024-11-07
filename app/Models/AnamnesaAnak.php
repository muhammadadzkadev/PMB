<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesaAnak extends Model
{
    use HasFactory;

    protected $table = 'anamnesa_anak';

    protected $fillable = [
        'pendaftaran_id',
        'riwayat_imunisasi',
        'riwayat_penyakit',
    ];

    public function pendaftaranMedis()
    {
        return $this->belongsTo(PendaftaranMedis::class, 'pendaftaran_id');
    }
}
