<?php

namespace App\Containers\Messagebus\Processors;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Messagebus\Data\Transporters\ProcessBookingFollowMessageTransporter;
use Illuminate\Support\Facades\Log;
use Interop\Queue\PsrContext;
use Interop\Queue\PsrMessage;
use Interop\Queue\PsrProcessor;

class BookingFollowProcessor implements PsrProcessor
{
    public function process(PsrMessage $message, PsrContext $context): bool
    {
        /** @var array $body */
        $body = $message->getBody();

        Log::info('Messagebus. Booking follow. Message received with the body: {body}', [
            'body' => json_encode($body),
        ]);

        Apiato::call('Messagebus@ProcessBookingFollowMessageAction', [
            new ProcessBookingFollowMessageTransporter($body['data'])
        ]);

        return self::ACK;
    }
}
