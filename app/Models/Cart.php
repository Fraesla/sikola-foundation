<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'merchandise_id',
        'qty'
    ];

    public function product()
    {
        return $this->belongsTo(Merchandise::class,'merchandise_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
