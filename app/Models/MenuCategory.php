<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuCategory extends Model
{
    protected $fillable = [
        'merchant_id',
        'nama_kategori',
        'deskripsi',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'menu_category_id');
    }
}
