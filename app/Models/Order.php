<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected static function booted(): void
    {
        // Auto-generate kode_order sebelum disimpan
        static::creating(function ($order) {
            $today   = now()->format('Ymd');
            $count   = static::whereDate('created_at', today())->count() + 1;
            $order->kode_order = 'ORD-' . $today . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()  { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}
