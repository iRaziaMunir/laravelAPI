<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'employeeNumber';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'employeeNumber',
        'firstName',
        'lastName',
        'extension',
        'email',
        'officeCode',
        'reportsTo',
        'jobTitle',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'officeCode', 'officeCode');
    }
}
