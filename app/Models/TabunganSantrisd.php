<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganSantrisd extends Model
{
    use HasFactory;
    protected $fillable = ['santri_id', 'tanggal_transaksi', 'jumlah', 'jenis_transaksi', 'keterangan'];

    // Relasi ke model DaftarSantri
    public function santri()
    {
        return $this->belongsTo(DaftarSantri::class, 'santri_id');
    }
}
