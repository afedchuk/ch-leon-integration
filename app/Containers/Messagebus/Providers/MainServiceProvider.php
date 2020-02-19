<?php

namespace App\Containers\Messagebus\Providers;

use App\Containers\Messagebus\Clients\AmqpClient;
use App\Containers\Messagebus\Contracts\MessagebusGatewayInterface;
use App\Containers\Messagebus\Contracts\MessageClientInterface;
use App\Containers\Messagebus\Contracts\MessageHandlerInterface;
use App\Containers\Messagebus\Gateways\MessagebusGateway;
use App\Containers\Messagebus\Handlers\MessageHandler;
use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        // InternalServiceProviderExample::class,
        EventsProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // ...

        $this->app->bind(
            MessageClientInterface::class,
            AmqpClient::class
        );
        $this->app->bind(
            MessagebusGatewayInterface::class,
            MessagebusGateway::class
        );
        $this->app->bind(
            MessageHandlerInterface::class,
            MessageHandler::class
        );
    }
}
