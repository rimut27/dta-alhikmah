<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfakHariansd extends Model
{
    use HasFactory;

    protected $fillable = ['santri_id', 'tanggal', 'jumlah'];

      // Relasi ke model DaftarSantri
      public function santri()
      {
          return $this->belongsTo(DaftarSantri::class, 'santri_id');
      }
}
