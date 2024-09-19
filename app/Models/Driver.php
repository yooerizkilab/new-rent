<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'phone_number',
        'license_number',
        'availability',
        'rate_per_day',
    ];

    // Define the relationships if any
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_drivers');
    }
}
