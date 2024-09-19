<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'address',
        'latitude',
        'longitude',
        'delivery_date',
    ];

    // Define the relationships if any
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
