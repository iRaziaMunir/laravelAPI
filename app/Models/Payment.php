<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'customerNumber';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customerNumber',
        'checkNumber',
        'paymentDate',
        'amount',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customerNumber', 'customerNumber');
    }
    
    public function getKeyName()
    {
        // Return a unique key (checkNumber) to avoid issues with Eloquent
        return 'checkNumber';
    }
}
