<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'kode_order',
        'total_harga',
        'ongkos_kirim',
        'nama_penerima',
        'no_telp_penerima',
        'alamat_pengiriman',
        'kota',
        'provinsi',
        'kode_pos',
        'bukti_pembayaran',
        'status',
        'no_resi',
        'ekspedisi',
        'poin_diberikan',
        'catatan',
        'alasan_batal',
        'bukti_refund',
        'dikonfirmasi_oleh',
        'dikonfirmasi_at',
    ];
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
    public function riwayatPoin()
    {
        return $this->morphMany(
            RiwayatPoin::class,
            'referensi'
        );
    }
    
}
