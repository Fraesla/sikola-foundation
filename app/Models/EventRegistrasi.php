<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class EventRegistrasi extends Model
{
    protected $table = 'events_registrasis';
    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'poin_diberikan',
        'catatan',
        'created_by',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
    public function riwayatPoin()
    {
        return $this->morphMany(
            RiwayatPoin::class,
            'referensi'
        );
    }
}
