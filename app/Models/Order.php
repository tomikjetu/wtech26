<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'subtotal',
        'delivery_price',
        'total_amount',
        'delivery_method',
        'delivery_title',
        'payment_method',
        'payment_title',
        'customer_email',
        'customer_phone',
        'customer_first_name',
        'customer_last_name',
        'customer_address',
        'customer_city',
        'customer_zip',
        'customer_country',
        'billing_same',
        'newsletter',
        'billing_first_name',
        'billing_last_name',
        'billing_address',
        'billing_city',
        'billing_zip',
        'billing_country',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'delivery_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'billing_same' => 'boolean',
        'newsletter' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
