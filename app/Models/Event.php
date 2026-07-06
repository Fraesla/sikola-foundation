<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventRegistrasi;

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

    public function registrasi()
    {
        return $this->hasMany(EventRegistrasi::class);
    }

}
