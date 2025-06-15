<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaihapalanDoaTk extends Model
{
       use HasFactory;

    protected $fillable = [
        'santri_id',
        'tanggal_penilaian',
        'doa',
        'nilai',
    ];
     public function santri()
    {
        return $this->belongsTo(DaftarSantriTK::class, 'santri_id');
    }
}