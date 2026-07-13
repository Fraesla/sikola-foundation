<?php

namespace App\Models;

use App\Models\Donasi;
use App\Models\RiwayatLanggananPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DonasiLangganan extends Model
{
    protected $table = 'donasi_langganans';

    protected $fillable = [
        'user_id',
        'donation_category_id',
        'jumlah_bulanan',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_aktif'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date',
        'is_aktif' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class,'langganan_id');
    }


    public function riwayat()
    {
        return $this->hasMany(
            RiwayatLanggananPembayaran::class,
            'langganan_id'
        );
    }
    public function riwayatAktif()
    {
        return $this->hasMany(RiwayatLanggananPembayaran::class,'langganan_id')
            ->where('status','dikonfirmasi')
            ->where('periode',$this->tanggal_mulai);
    }
    public function getTotalPoinAktifAttribute()
    {
        return $this->riwayat()
            ->where('status', 'dikonfirmasi')
            ->where('periode', $this->tanggal_mulai)
            ->sum(DB::raw('poin + bonus'));
    }
    public function riwayatPembayaran()
    {
        return $this->hasMany(
            RiwayatLanggananPembayaran::class,
            'langganan_id'
        );
    }
    public function getTotalTerkumpulAttribute()
    {
        return $this->riwayatPembayaran()
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');
    }

}
