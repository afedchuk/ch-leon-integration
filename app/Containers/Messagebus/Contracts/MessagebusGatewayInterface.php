<?php

namespace App\Containers\Messagebus\Contracts;

interface MessagebusGatewayInterface
{
    /**
     * @param array $updates
     */
    public function sendBookingUpdates(array $updates): void;
}
