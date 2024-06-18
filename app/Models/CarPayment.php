<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPayment extends Model
{
    use HasFactory;
     protected $fillable = [
        'created_date',
        'customer_email',
        'customer_mobile',
        'customer_name',
        'customer_reference',
        'expiry_date',
        'invoice_display_value',
        'invoice_id',
        'invoice_reference',
        'invoice_status',
        'invoice_value'
    ];
}
