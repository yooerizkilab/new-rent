<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';

    protected $fillable = [
        'car_id',
        'description',
        'maintenance_date',
        'cost',
    ];

    // Define the relationships if any
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
