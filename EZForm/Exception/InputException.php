<?php

namespace EZForm\Exception;

use Exception;
use Throwable;

class InputException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("MISSCONFIGURED INPUT: " . $message, $code, $previous);
    }

}
