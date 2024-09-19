<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'rating',
        'comment',
    ];

    // Define the relationships if any
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'rental_id');
    }
}
