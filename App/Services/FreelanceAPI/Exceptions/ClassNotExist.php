<?php

namespace App\Services\FreelanceAPI\Exceptions;

/**
 * Class ClassNotExist
 * @package App\Services\FreelanceAPI\Exceptions
 */
class ClassNotExist extends \Exception
{
    protected $code = 406;
}