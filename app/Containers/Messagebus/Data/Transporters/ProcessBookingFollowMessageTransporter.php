<?php

namespace App\Containers\Messagebus\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class ProcessBookingFollowMessageTransporter extends Transporter
{
    protected $schema = [
        'type'       => 'object',
        'properties' => [
            'internalReferenceNumber',
            'followUntil',
        ],
        'required'   => [
            'internalReferenceNumber',
            'followUntil',
        ],
    ];
}
