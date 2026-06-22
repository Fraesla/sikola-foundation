<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
     protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'kategori',
        'berat_gram',
        'poin_reward',
        'is_aktif',
        'created_by'
    ];

    protected function casts(): array
    {
        return [
            'gambar' => 'array',
            'is_aktif' => 'boolean',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
