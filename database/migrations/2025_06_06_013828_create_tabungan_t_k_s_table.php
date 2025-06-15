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
        Schema::create('tabungan_t_k_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('daftar_santri_t_k_s')->onDelete('cascade');
            $table->date('tanggal_transaksi');
            $table->decimal('jumlah', 10, 2);
            $table->string('jenis_transaksi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan_t_k_s');
    }
};
