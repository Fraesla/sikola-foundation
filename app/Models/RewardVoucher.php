<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardVoucher extends Model
{
    protected $fillable = [

        'reward_id',
        'user_id',
        'order_id',
        'kode',
        'nominal',
        'status',
        'berlaku_mulai',
        'berlaku_sampai',
        'digunakan_pada'

    ];

    protected $casts = [

        'berlaku_mulai' => 'datetime',
        'berlaku_sampai' => 'datetime',
        'digunakan_pada' => 'datetime',

    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Cek apakah voucher masih valid.
     */
    public function isValid()
    {
        return $this->status == 'aktif'
            && (!$this->berlaku_sampai || now()->lt($this->berlaku_sampai));
    }
}
