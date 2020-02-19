<?php

namespace App\Containers\Leon\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InvalidResponseJsonException
 * @package App\Containers\Leon\Exceptions
 */
class InvalidResponseJsonException extends Exception
{
    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Invalid JSON.';
}
