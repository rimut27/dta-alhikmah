<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absensisd extends Model
{
    protected $fillable = ['santri_id', 'tanggal', 'status'];

    public function santri()
    {
        return $this->belongsTo(DaftarSantri::class, 'santri_id');
    }
}
