<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'nomor_transaksi',
        'nomor_pesanan_midtrans',
        'metode_pembayaran',
        'status_pembayaran',
        'snap_token',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
