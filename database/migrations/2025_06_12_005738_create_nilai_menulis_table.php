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
        Schema::create('nilai_menulis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('daftar_santri_t_k_s')->onDelete('cascade');
            $table->date('tanggal_penilaian');
            $table->string('jilid')->nullable();
            $table->integer('halaman')->nullable();
            $table->integer('nilai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_menulis');
    }
};
