<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftarSantriTK extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_santri',
        'jk',
        'tanggal_lahir',
        'nama_ayah',
        'nama_ibu',
        'nama_sekolah',
        'alamat'
    ];

    public function absensi()
    {
        return $this->hasMany(AbsensiTK::class, 'santri_id');
    }
    public function tabungan()
    {
        return $this->hasMany(TabunganTK::class, 'santri_id');
    }

    public function nilaiMembaca()
    {
        return $this->hasMany(NilaiMembaca::class, 'santri_id');
    }

    public function infak()
    {
        return $this->hasMany(infaktk::class, 'santri_id');
    }

    public function nilaiMenulis()
    {
        return $this->hasMany(NilaiMenulis::class, 'santri_id');
    }

    public function praktekShalat()
    {
        return $this->hasMany(Praktekshalat::class, 'santri_id');
    }

    public function nilaiHapalanDoa()
    {
        return $this->hasMany(NilaihapalanDoaTk::class, 'santri_id');
    }

    public function nilaiHapalanSurah()
    {
        return $this->hasMany(NilaihapalansurahTK::class, 'santri_id');
    }
}
