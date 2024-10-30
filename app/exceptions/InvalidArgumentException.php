<?php

namespace App\Exceptions;

use Exception;

class InvalidArgumentException extends Exception {
    public function __construct($message = "Argumento inválido") {
        parent::__construct($message);
    }
}
?>