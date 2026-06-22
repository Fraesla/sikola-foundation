<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
     protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'url_tautan',
        'urutan',
        'is_aktif',
        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
