<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiAlquransd extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'tanggal_penilaian',
        'surat',
        'halaman',
        'nilai',
    ];

    public function santri()
    {
        return $this->belongsTo(DaftarSantri::class, 'santri_id');
    }
}
