<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\OrderItem;
use App\Models\Invoice;
use App\Models\Payment;

class Order extends Model
{
        protected $fillable = [
        'nomor_pesanan',
        'customer_id',
        'merchant_id',
        'tanggal_pengiriman',
        'alamat_pengiriman',
        'catatan',
        'total_harga',
        'status_pesanan',
    ];

    protected $casts = [
        'tanggal_pengiriman' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
