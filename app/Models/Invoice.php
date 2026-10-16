<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'order_id',
        'nomor_invoice',
        'tanggal_terbit',
        'tanggal_jatuh_tempo',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_terbit' => 'datetime',
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
