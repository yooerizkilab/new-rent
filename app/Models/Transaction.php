<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'payment_method',
        'amount',
        'payment_date',
        'status',
        'snap_token',
    ];

    // Define the relationships if any
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'rental_id');
    }
}
