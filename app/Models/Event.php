<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'start_time',
        'location',
        'price',
        'capacity',
    ];

    // Tell Laravel that 'start_time' is a date, not just text
    protected $casts = [
        'start_time' => 'datetime',
    ];

    // Relationship: An event belongs to a User (The Creator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An event belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: An event has many Bookings (Tickets)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
