<?php

namespace App\Containers\BookingFollow\Models;

use App\Ship\Parents\Models\Model;

class BookingFollow extends Model
{
    protected $fillable = [
        'reference_number',
        'follow_until',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'follow_until',
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'booking_follows';
}
