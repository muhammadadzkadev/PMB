<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranMedisTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('pendaftaran_medis');

        Schema::create('pendaftaran_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->date('tanggal_daftar');
            $table->enum('jenis_kunjungan', ['Baru', 'Lama']);
            $table->enum('status_hamil', ['Ya', 'Tidak']);
            $table->unsignedBigInteger('poli_id');
            $table->timestamps();
        });

        Schema::table('pendaftaran_medis', function (Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('poli_id')->references('id')->on('poli')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_medis');
    }
}