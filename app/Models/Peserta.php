<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';

    protected $fillable = [

        'event_id',
        'event_registrasi_id',
        'user_id',

        'status',

        'poin',

        'total_scan',
        'total_hadir',
        'total_tidak_hadir',

        'persentase_kehadiran',

        'nomor_sertifikat',
        'sertifikat',
        'sertifikat_diterbitkan',
        'lulus_pada',

        'poin_berikan',

        'catatan',
    ];

    protected $casts = [

        'persentase_kehadiran' => 'decimal:2',
        'sertifikat_diterbitkan' => 'datetime',
        'poin_berikan' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relawan()
    {
        return $this->belongsTo(Relawan::class, 'user_id', 'user_id');
    }

    public function registrasi()
    {
        return $this->belongsTo(
            EventRegistrasi::class,
            'event_registrasi_id'
        );
    }

    public function absensi()
    {
        return $this->hasMany(
            Absensi::class,
            'event_peserta_id'
        );
    }

    public function absensiDetails()
    {
        return $this->hasMany(
            AbsensiDetail::class,
            'event_peserta_id'
        );
    }
}