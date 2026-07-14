<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $table = 'tiers';

    protected $fillable = [
        'nama',
        'min_poin',
        'max_poin',
        'badge_icon',
        'warna_hex',
        'deskripsi',
        'keuntungan',
        'urutan',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'keuntungan' => 'array',
        'prioritas_event' => 'boolean',
        'gratis_ongkir' => 'boolean',
        'aktif' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
