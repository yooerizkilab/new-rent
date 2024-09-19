<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'driver_id',
    ];

    // Define the relationships if any
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
