<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPaymentTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_payment_id',
        'authorization_id',
        'currency',
        'customer_service_charge',
        'due_value',
        'error_code',
        'paid_currency',
        'paid_currency_value',
        'payment_gateway',
        'payment_id',
        'reference_id',
        'track_id',
        'transaction_date',
        'transaction_id',
        'transaction_status',
        'transaction_value'
    ];
}
