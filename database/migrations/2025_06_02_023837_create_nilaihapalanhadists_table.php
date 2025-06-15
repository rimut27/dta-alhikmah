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
        Schema::create('nilaihapalanhadists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('daftar_santris')->onDelete('cascade');
            $table->date('tanggal_penilaian');
            $table->string('hadist');
            $table->integer('nilai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilaihapalanhadists');
    }
};
