<?php

namespace Broobe\Services\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    protected $message = 'Model not found.';
}
