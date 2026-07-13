<?php

namespace App\Models;

use App\Models\Donasi;
use App\Models\DonasiLangganan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class RiwayatLanggananPembayaran extends Model
{
    protected $table = 'riwayat_langganan_pembayaran';

    protected $fillable = [
        'langganan_id',
        'donasi_id',
        'periode',
        'jumlah',
        'poin',
        'bonus',
        'bonus_periode',
        'bukti_transfer',
        'status',
        'alasan_tolak',
        'dikonfirmasi_oleh',
        'dikonfirmasi_at',
        'rewarded_at',
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

    public function donasi()
    {
        return $this->belongsTo(
            Donasi::class,
            'donasi_id'
        );
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatLanggananPembayaran::class);
    }
    public function riwayatPoin()
    {
        return $this->morphMany(
            RiwayatPoin::class,
            'referensi'
        );
    }
}
