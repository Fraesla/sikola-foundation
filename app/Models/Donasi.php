<?php

namespace App\Models;

use App\Models\DonasiLangganan;
use App\Models\User;
use App\Models\DonationCategory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasis';
    
    protected $fillable = [
        'user_id',
        'donation_category_id',
        'langganan_id',
        'tipe',
        'jumlah',
        'pesan',
        'bukti_transfer',
        'status',
        'alasan_tolak',
        'poin_diberikan',
        'dikonfirmasi_oleh',
        'dikonfirmasi_at',
        'created_at',
        'updated_at'
    ];

    // Donasi.php
    public function langganan()
    {
        return $this->hasOne(DonasiLangganan::class, 'id', 'langganan_id');
    }

    public function kategori()
    {
        return $this->belongsTo(
            DonationCategory::class,
            'donation_category_id'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getGambarProgramAttribute()
    {
        if ($this->tipe == 'bulanan') {

            return $this->langganan?->gambar
                ? asset('storage/'.$this->langganan->gambar)
                : asset('images/default-langganan.jpg');
        }

        return $this->kategori?->gambar
            ? asset('storage/'.$this->kategori->gambar)
            : asset('images/default-donasi.jpg');
    }
    public function riwayatPoin()
    {
        return $this->morphMany(
            RiwayatPoin::class,
            'referensi'
        );
    }
}