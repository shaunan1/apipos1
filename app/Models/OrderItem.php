<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'subtotal'];

    /**
     * Relasi ke tabel orders
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke tabel products
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
