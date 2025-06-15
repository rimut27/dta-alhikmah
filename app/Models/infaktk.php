<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\daftarSantriTK;

class infaktk extends Model
{
    use HasFactory;
    protected $table = 'infaktks'; // Nama tabel di database

    protected $fillable = ['santri_id', 'tanggal', 'jumlah'];
    
    // Relasi ke model DaftarSantri
    public function santri()
    {
        return $this->belongsTo(daftarSantriTK::class, 'santri_id');
    }
}
