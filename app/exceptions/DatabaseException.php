<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct($message = "Error de base de datos", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

?>