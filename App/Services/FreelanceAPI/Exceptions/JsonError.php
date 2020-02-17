<?php

namespace App\Services\FreelanceAPI\Exceptions;

/**
 * Class JsonError
 * @package App\Services\FreelanceAPI\Exceptions
 */
class JsonError extends \Exception
{
    protected $code    = 406;
    protected $message = "Json decode error";
}