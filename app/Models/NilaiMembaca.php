<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiMembaca extends Model
{
    use HasFactory;
    
    protected $fillable  = [
        'santri_id',
        'tanggal_penilaian',
        'iqra',
        'halaman',
        'nilai',
    ];
    
    public function santri()
    {
        return $this->belongsTo(DaftarSantriTK::class, 'santri_id');
    }
}
