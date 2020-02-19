<?php

namespace App\Containers\Leon\Contracts;

use App\Containers\Leon\Guzzle\Request;
use App\Containers\Leon\Guzzle\Response;

/**
 * Interface RequestHandlerInterface
 * @package App\Containers\Leon\Contracts
 */
interface RequestHandlerInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response;
}
