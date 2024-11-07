<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('patients', function (Blueprint $table) {
        $table->id();
        $table->string('no_dokumen_rm')->nullable();
        $table->string('penjamin');
        $table->string('golongan_darah')->nullable();
        $table->string('no_kk');
        $table->string('email')->nullable();
        $table->string('nik')->unique();
        $table->string('no_hp')->nullable();
        $table->string('nama');
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->date('tanggal_lahir');
        $table->string('tempat_lahir');
        $table->string('provinsi');
        $table->string('kota');
        $table->string('kecamatan');
        $table->string('kelurahan');
        $table->text('alamat');
        $table->string('rt')->nullable();
        $table->string('rw')->nullable();
        $table->string('pekerjaan')->nullable();
        $table->string('pekerjaan_suami')->nullable();
        $table->string('instansi')->nullable();
        $table->string('agama');
        $table->string('pendidikan');
        $table->string('status_perkawinan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
