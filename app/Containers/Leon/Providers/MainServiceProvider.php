<?php

namespace App\Containers\Leon\Providers;

use App\Containers\Leon\Clients\GuzzleClient;
use App\Containers\Leon\Contracts\HttpClientInterface;
use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Contracts\RequestHandlerInterface;
use App\Containers\Leon\Gateways\LeonGateway;
use App\Containers\Leon\Handlers\LeonRequestHandler;
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
        EventsProvider::class,
        // InternalServiceProviderExample::class,
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

        $this->app->singleton(
            HttpClientInterface::class,
            GuzzleClient::class
        );
        $this->app->bind(
            RequestHandlerInterface::class,
            LeonRequestHandler::class
        );
        $this->app->singleton(
            LeonGatewayInterface::class,
            LeonGateway::class
        );
    }
}
