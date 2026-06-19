<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name','email','password','google_id','avatar',
                            'role','tier_id','total_poin','is_active'];

    protected $casts = ['email_verified_at' => 'datetime', 'is_active' => 'boolean'];

    // ─ Relations ─
    public function tier()          { return $this->belongsTo(Tier::class); }
    public function relawan()       { return $this->hasOne(Relawan::class); }
    public function donasis()       { return $this->hasMany(Donasi::class); }
    public function orders()        { return $this->hasMany(Order::class); }
    public function eventRegistrasis() { return $this->hasMany(EventRegistrasi::class); }
    public function langganans()    { return $this->hasMany(DonasiLangganan::class); }

    // ─ Helpers ─
    public function isAdmin()    { return $this->role === 'admin'; }
    public function isRelawan() { return $this->role === 'relawan'; }
    public function isDonatur() { return $this->role === 'donatur'; }
}
