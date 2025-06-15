<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMenulis extends Model
{
       protected $fillable  = [
        'santri_id',
        'tanggal_penilaian',
        'jilid',
        'halaman',
        'nilai',
    ];
    
    public function santri()
    {
        return $this->belongsTo(DaftarSantriTK::class, 'santri_id');
    }
}

