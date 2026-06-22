<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_cover',
        'kategori',
        'status',
        'published_at',
        'views',
        'created_by'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
