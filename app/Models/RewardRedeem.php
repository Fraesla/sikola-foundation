<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardRedeem extends Model
{
    use HasFactory;

    protected $table = 'reward_redemptions';

    protected $fillable = [

        'kode',

        'user_id',

        'reward_id',

        'qty',

        'poin',

        'total_poin',

        'status',

        'catatan_user',

        'catatan_admin',

        'bukti_penyerahan',

        'ekspedisi',

        'nomor_resi',

        'diproses_oleh',

        'diproses_at',

        'selesai_at',

        'dibatalkan_at',

        'dibatalkan_oleh',

        'dibatalkan_sebagai',

    ];

    protected $casts = [

        'diproses_at'   => 'datetime',

        'selesai_at'    => 'datetime',

        'dibatalkan_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    /**
     * User yang melakukan redeem
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reward yang ditukar
     */
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    /**
     * Admin yang memproses
     */
    public function processor()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotalPoinAttribute()
    {
        return number_format($this->total_poin) . ' Poin';
    }

    public function getFormattedPoinAttribute()
    {
        return number_format($this->poin) . ' Poin';
    }

    public function getBadgeStatusAttribute()
    {
        return match ($this->status) {
            'menunggu'   => 'warning',
            'diproses'   => 'info',
            'selesai'    => 'success',
            'dibatalkan' => 'danger',
            default      => 'secondary',
        };
    }
}
