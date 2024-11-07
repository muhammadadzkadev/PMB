<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pendaftaran;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $fillable = [
        'nama_poli',
    ];

    // Relasi dengan tabel pendaftaran
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranMedis::class);
    }
}