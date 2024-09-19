<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'last_name',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define the relationships if any
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
