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
        Schema::create('anamnesa_kia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_medis')->onDelete('cascade');
            $table->date('hpht')->nullable();
            $table->integer('g')->nullable();
            $table->integer('p')->nullable();
            $table->integer('a')->nullable();
            $table->integer('jarak_persalinan')->nullable();
            $table->string('cara_persalinan')->nullable();
            $table->string('riwayat_kb_terakhir')->nullable();
            $table->decimal('tb', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesa_kia');
    }
};
