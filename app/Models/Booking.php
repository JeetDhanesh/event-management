<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'event_id', 'status'];

    // Relationship: A booking belongs to a User (The Buyer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A booking belongs to an Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
