<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orderdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderNumber',
        'productCode',
        'quantityOrdered',
        'priceEach',
        'orderLineNumber',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderNumber', 'orderNumber');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productCode', 'productCode');
    }
}
