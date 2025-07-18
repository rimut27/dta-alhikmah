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
        Schema::create('infaktks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('daftar_santri_t_k_s')->onDelete('cascade');
            $table->date('tanggal');
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infaktks');
    }
};
