<?php

namespace App\Models;

use App\Models\Donasi;
use Illuminate\Database\Eloquent\Model;

class DonasiLangganan extends Model
{
    protected $table = 'donasi_langganans';

    protected $fillable = [
        'user_id',
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
}
