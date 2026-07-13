<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPoin extends Model
{
    protected $fillable = [

        'user_id',

        'tipe',

        'poin',

        'kategori',

        'referensi_type',

        'referensi_id',

        'keterangan',

    ];

    protected $casts = [

        'kategori' => \App\KategoriPoin::class,

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referensi()
    {
        return $this->morphTo();
    }

    public function riwayatPoin()
    {
        return $this->hasMany(RiwayatPoin::class);
    }
}
