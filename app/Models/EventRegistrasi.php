<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

class EventRegistrasi extends Model
{
    protected $table = 'events_registrasis';

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'catatan',
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

    public function peserta()
    {
        return $this->hasOne(Peserta::class,'event_registrasi_id');
    }

    public function riwayatPoin()
    {
        return $this->morphMany(
            RiwayatPoin::class,
            'referensi'
        );
    }
}