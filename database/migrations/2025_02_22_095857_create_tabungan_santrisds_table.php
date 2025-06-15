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
        Schema::create('tabungan_santrisds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->date('tanggal_transaksi');
            $table->decimal('jumlah', 10, 2);
            $table->string('jenis_transaksi');
            $table->text('keterangan')->nullable();
            // Menambahkan foreign key
            $table->foreign('santri_id')->references('id')->on('daftar_santris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan_santrisds');
    }
};
