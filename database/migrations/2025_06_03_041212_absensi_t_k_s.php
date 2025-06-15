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
        Schema::create('absensi_t_k_s', function (Blueprint $table) {  $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->date('tanggal')->default(now());
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alfa'])->default('hadir');
            $table->timestamps();

            $table->foreign('santri_id')->references('id')->on('daftar_santri_t_k_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
