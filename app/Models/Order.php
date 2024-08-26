<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'orderNumber';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'orderNumber',
        'orderDate',
        'requiredDate',
        'shippedDate',
        'status',
        'comments',
        'customerNumber',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customerNumber', 'customerNumber');
    }
}
