<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMedis extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'tanggal_daftar',
        'jenis_kunjungan',
        'poli_id',
        'status_hamil',
    ];

    protected $appends = ['status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }

    public function anamnesaAnak()
    {
        return $this->hasMany(AnamnesaAnak::class, 'pendaftaran_id');
    }

    public function rekamMedisAnak()
    {
        return $this->hasMany(RekamMedisAnak::class, 'pendaftaran_id');
    }

    public function anamnesaKIA()
    {
        return $this->hasMany(AnamnesaKIA::class, 'pendaftaran_id');
    }

    public function rekamMedisKIA()
    {
        return $this->hasMany(RekamMedisKIA::class, 'pendaftaran_id');
    }

    public function anamnesaKB()
    {
        return $this->hasMany(AnamnesaKB::class, 'pendaftaran_id');
    }

    public function rekamMedisKB()
    {
        return $this->hasMany(RekamMedisKB::class, 'pendaftaran_id');
    }

    public function getStatusAttribute()
    {
        return $this->rekamMedisAnak()->exists() || 
               $this->rekamMedisKIA()->exists() || 
               $this->rekamMedisKB()->exists();
    }

}