<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 18:17
 */

namespace EZForm\Exception;


use Throwable;

class FormException extends InputException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("FORM: ".$message, $code, $previous);
    }

}
