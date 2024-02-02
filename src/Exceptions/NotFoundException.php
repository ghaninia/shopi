<?php

namespace Shopi\Exceptions;

use Exception;

class NotFoundException extends Exception {
    public function __construct($message = null) {
        $message = $message ?: "not found!";
        parent::__construct($message);
    }
}