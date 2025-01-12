<?php

namespace App\Exceptions;
use Exception;
use Throwable;

class ApiException extends Exception
{
    public function __construct(
        string       $message = "",
        public array $data = [],
        int          $code = 400,
        ?Throwable   $previous = null,
    ) {
        parent::__construct( $message, $code, $previous );
    }
}
