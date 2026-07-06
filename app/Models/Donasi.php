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
        'tanggal_lahir',
        'tipe',
        'jumlah',
        'pesan',
        'bukti_transfer',
        'status',
        'alasan_tolak',
        'point_diberikan',
        'dikonformasi_oleh',
        'dikonformasi_at',
        'created_at',
        'updated_at'
    ];

    public function langganan()
    {
        return $this->belongsTo(
            DonasiLangganan::class,
            'langganan_id'
        );
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
}
