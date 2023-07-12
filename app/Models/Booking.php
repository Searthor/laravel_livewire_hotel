<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'booking_date',
        'advance_payment',
        'remaining_price',
        'payment_status',
    ];
    
   
}
