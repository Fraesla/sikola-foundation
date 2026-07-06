<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DonationCategory extends Model
{
    protected $table = 'donasi_kategori';
    
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon',
        'gambar',
        'minimal_donasi',
        'maksimal_donasi',
        'target_default',
        'lokasi',
        'is_aktif',
        'created_by'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if (empty($item->slug)) {
                $item->slug = Str::slug($item->nama);
            }
        });
    }
    public function donasis()
    {
        return $this->hasMany(
            Donasi::class,
            'donation_category_id'
        );
    }
}
