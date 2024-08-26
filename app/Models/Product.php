<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'productCode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'productCode',
        'productName',
        'productline',
        'productScale',
        'productVendor',
        'productDescription',
        'quantityInStock',
        'buyPrice',
        'MSRP',
    ];

    public function productLine(): BelongsTo
    {
        return $this->belongsTo(Productline::class, 'productline', 'productLine');
    }
}
