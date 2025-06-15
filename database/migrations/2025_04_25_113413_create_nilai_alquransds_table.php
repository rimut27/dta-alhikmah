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
        Schema::create('nilai_alquransds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('daftar_santris')->onDelete('cascade');
            $table->date('tanggal_penilaian');
            $table->string('surat');
            $table->string('halaman');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_alquransds');
    }
};
