<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'transmission',
        'fuel',
        'mileage',
        'baggage',
        'seat',
        'feature',
        'license_plate',
        'description',
        'image',
        'units',
        'status',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'penalty_rate_per_day',
    ];

    // Define the relationships if any
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'car_drivers');
    }
}
