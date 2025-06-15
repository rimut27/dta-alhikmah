<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Praktekshalat extends Model
{
    protected $fillable = [
        'santri_id',
        'tanggal_penilaian',
        'nilai',
        'keterangan',
    ];
    public function santri()
    {
        return $this->belongsTo(DaftarSantriTK::class, 'santri_id');
    }
}