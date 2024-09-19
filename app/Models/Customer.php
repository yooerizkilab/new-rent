<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'phone_number',
        'email',
        'address',
        'photo',
        'photo_idcard',
    ];

    // Define the relationships if any
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
