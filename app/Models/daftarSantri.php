<?php

namespace App\Models;

use App\Models\TabunganSantrisd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftarSantri extends Model
{
    use HasFactory;
    protected $fillable = ['nama_santri', 'jk', 'tanggal_lahir', 'nama_ayah', 'nama_ibu', 'kelas', 'nama_sekolah', 'alamat'];

    public function tabungan()
    {
        return $this->hasMany(TabunganSantrisd::class, 'santri_id');
    }
    public function infak()
    {
        return $this->hasMany(InfakHariansd::class, 'santri_id');
    }

    public function nilaiAlquransds()
    {
        return $this->hasMany(NilaiAlquransd::class, 'santri_id');
    }
    public function nilaiHafalanDoas()
    {
        return $this->hasMany(NilaihapalanDoa::class, 'santri_id');
    }
    public function nilaiHafalanHadists()
    {
        return $this->hasMany(Nilaihapalanhadist::class, 'santri_id');
    }
}
