<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_id',
        'start_date',
        'end_date',
        'total_price',
        'status_price',
        'status',
        'driver_cost',
        'fuel_cost',
        'toll_cost',
        'penalty_amount',
        'delivery_cost',
    ];

    // Define the relationships if any
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function deliveryLocation()
    {
        return $this->hasOne(DeliveryLocation::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
