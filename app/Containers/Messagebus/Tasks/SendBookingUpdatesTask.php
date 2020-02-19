<?php

namespace App\Containers\Messagebus\Tasks;

use App\Containers\Messagebus\Contracts\MessagebusGatewayInterface;
use App\Ship\Parents\Tasks\Task;

class SendBookingUpdatesTask extends Task
{
    /**
     * @var MessagebusGatewayInterface
     */
    private $gateway;

    /**
     * SendBookingUpdatesTask constructor.
     * @param MessagebusGatewayInterface $gateway
     */
    public function __construct(MessagebusGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function run(array $updates)
    {
        $this->gateway->sendBookingUpdates($updates);
    }
}
