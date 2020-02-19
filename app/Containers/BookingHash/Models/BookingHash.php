<?php

namespace App\Containers\BookingHash\Models;

use App\Ship\Parents\Models\Model;

class BookingHash extends Model
{
    protected $fillable = [
        'reference_number',
        'hash',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'booking_hashes';
}
