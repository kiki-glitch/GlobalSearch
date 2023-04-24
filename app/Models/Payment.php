<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'first_name',
        'last_name',
        'customer_id',
        'amount',
        'account_number',
        'transaction_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
