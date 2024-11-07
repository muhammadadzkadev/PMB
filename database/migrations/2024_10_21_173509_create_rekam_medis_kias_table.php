<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekam_medis_kias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_medis')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('td');
            $table->decimal('bb', 5, 2);
            $table->decimal('lila', 5, 2)->nullable();
            $table->decimal('lingkar_perut', 5, 2)->nullable();
            $table->decimal('tfu', 5, 2);
            $table->string('letak_janin');
            $table->string('djj');
            $table->text('keluhan');
            $table->text('analisis');
            $table->text('penatalaksanaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_kias');
    }
};