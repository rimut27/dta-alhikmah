<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TabunganTK extends Model
{
    use HasFactory;
    protected $fillable = ['santri_id', 'tanggal_transaksi', 'jumlah', 'jenis_transaksi', 'keterangan'];
    
    // Relasi ke model DaftarSantri
    public function santri()
    {
        return $this->belongsTo(daftarSantriTK::class, 'santri_id');
    }
}
