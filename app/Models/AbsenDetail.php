<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenDetail extends Model
{
    protected $table = 'absen_details';

    protected $fillable = [

        'absensi_id',

        'event_id',

        'event_peserta_id',

        'hari_ke',

        'waktu_scan',

        'status',

        'scan_ke',

        'valid',

        'durasi',

        'device',

        'ip_address',

        'catatan'

    ];

    protected $casts = [

        'waktu_scan' => 'datetime',

        'valid' => 'boolean',

    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function peserta()
    {
        return $this->belongsTo(
            Peserta::class,
            'event_peserta_id'
        );
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}