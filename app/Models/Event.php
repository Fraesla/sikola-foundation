<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'kuota',
        'poin_reward',
        'status',
        'created_by'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
