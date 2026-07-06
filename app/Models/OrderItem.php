<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $table = 'order_items';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'merchandise_id',
        'nama_produk',
        'harga_satuan',
        'kuantitas',
        'subtotal'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // OrderItem milik satu Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // OrderItem berasal dari satu Merchandise
    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class);
    }
}
