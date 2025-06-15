<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilaihafalansurahsd extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'santri_id',
        'tanggal_penilaian',
        'surat',
        'ayat',
        'nilai',
    ];

    public function santri()
    {
        return $this->belongsTo(DaftarSantri::class, 'santri_id');
    }

}
