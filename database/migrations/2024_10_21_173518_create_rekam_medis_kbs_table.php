<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis_kbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_medis')->onDelete('cascade');
            $table->date('tanggal');
            $table->date('hari_terakhir_haid')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('pemeriksaan')->nullable();
            $table->text('analisa_diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->date('kunjungan_ulang')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_kbs');
    }
};