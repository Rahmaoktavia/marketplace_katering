<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'menu_category_id',
        'nama_menu',
        'deskripsi',
        'harga',
        'foto',
        'tersedia',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'tersedia' => 'boolean',
        ];
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
