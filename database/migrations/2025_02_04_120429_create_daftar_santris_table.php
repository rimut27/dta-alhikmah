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
        Schema::create('daftar_santris', function (Blueprint $table) {
                $table->id();
                $table->string('nama_santri');
                $table->date('tanggal_lahir');
                $table->string('jk');
                $table->string('nama_ayah');
                $table->string('nama_ibu');
                $table->string('kelas'); 
                $table->string('nama_sekolah');
                $table->text('alamat');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_santris');
    }
};
