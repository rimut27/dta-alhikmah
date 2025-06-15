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
        Schema::create('absensisds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->date('tanggal')->default(now());
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alfa'])->default('hadir');
            $table->timestamps();

            $table->foreign('santri_id')->references('id')->on('daftar_santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensisds');
    }
};
