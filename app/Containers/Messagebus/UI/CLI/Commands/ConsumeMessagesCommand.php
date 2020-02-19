<?php

namespace App\Containers\Messagebus\UI\CLI\Commands;

use App\Containers\Messagebus\Contracts\MessageClientInterface;
use App\Containers\Messagebus\Processors\BookingFollowProcessor;
use App\Ship\Parents\Commands\ConsoleCommand;
use Illuminate\Support\Facades\Config;

class ConsumeMessagesCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:consume {--timeout=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consuming messages from message bus.';

    /**
     * @var MessageClientInterface
     */
    protected $messageClient;

    /**
     * ConsumeMessagesCommand constructor.
     * @param MessageClientInterface $client
     */
    public function __construct(MessageClientInterface $client)
    {
        parent::__construct();

        $this->messageClient = $client;
    }

    public function handle()
    {
        $timeout = (int)$this->option('timeout');

        if ($timeout === 0) {
            $this->error('Timeout must be greater than 0');
            return false;
        }

        $this->messageClient->subscribe(
                Config::get('messagebus-container.messages.bookings.follow'),
                new BookingFollowProcessor()
            );

        $this->line('Starting consumption...');

        $this->messageClient
            ->consume($timeout);
    }
}
