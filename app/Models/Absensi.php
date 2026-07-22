<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AbsenDetail;

class Absensi extends Model
{
    protected $table = 'absensis';

    protected $fillable = [

        'event_id',

        'event_peserta_id',

        'hari_ke',

        'tanggal',

        'target_scan',

        'total_scan',

        'hadir',

        'tidak_hadir',

        'persentase',

        'status',

        'selesai',

        'selesai_pada',

        'dibuat_otomatis',

        'catatan',

    ];

    protected $casts = [

        'tanggal' => 'date',

        'persentase' => 'decimal:2',

        'selesai' => 'boolean',

        'dibuat_otomatis' => 'boolean',

        'selesai_pada' => 'datetime',

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

    public function peserta()
    {
        return $this->belongsTo(
            Peserta::class,
            'event_peserta_id'
        );
    }

    public function details()
    {
        return $this->hasMany(
            AbsenDetail::class
        );
    }
    
    public function getPersentaseAttribute()
    {
        if ($this->total_scan == 0) {
            return 0;
        }

        return round(
            ($this->total_hadir / $this->total_scan) * 100,
            2
        );
    }
}