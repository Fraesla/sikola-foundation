<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
   
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = [

        'nama',
        'slug',
        'deskripsi',
        'gambar',
        'kategori',
        'poin',
        'stok',
        'urutan',
        'is_aktif',
        'created_by',

    ];

    protected $casts = [

        'is_aktif' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    /**
     * Admin pembuat reward
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Riwayat penukaran reward
     */
    public function redemptions()
    {
        return $this->hasMany(RewardRedeem::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    /**
     * Reward yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_aktif', true);
    }

    /**
     * Reward yang masih memiliki stok
     */
    public function scopeAvailable($query)
    {
        return $query->where('stok', '>', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    /**
     * Status stok
     */
    public function getStatusStokAttribute()
    {
        if ($this->stok <= 0) {
            return 'Habis';
        }

        if ($this->stok <= 10) {
            return 'Hampir Habis';
        }

        return 'Tersedia';
    }

    public function getFormattedPoinAttribute()
    {
        return number_format($this->poin) . ' Poin';
    }

    public function getIsReadyAttribute()
    {
        return $this->is_aktif && $this->stok > 0;
    }
}
