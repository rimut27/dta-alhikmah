<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiTK extends Model
{
    protected $fillable = ['santri_id', 'tanggal', 'status'];

    public function santri()
    {
        return $this->belongsTo(daftarSantriTK::class, 'santri_id');
    }
}
