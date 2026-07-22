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
        'poin_penalty',

        'interval_scan',
        'toleransi_scan',

        'status',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrasis()
    {
        return $this->hasMany(EventRegistrasi::class);
    }

    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function absensiDetails()
    {
        return $this->hasMany(AbsensiDetail::class);
    }
}