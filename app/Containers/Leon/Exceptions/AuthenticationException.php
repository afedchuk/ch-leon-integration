<?php

namespace App\Containers\Leon\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticationTokenException
 * @package App\Containers\Leon\Exceptions
 */
class AuthenticationException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'Could not authorize.';
}
