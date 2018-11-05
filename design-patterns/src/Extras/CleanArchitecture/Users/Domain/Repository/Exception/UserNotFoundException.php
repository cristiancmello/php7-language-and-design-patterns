<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception;

class UserNotFoundException extends \Exception
{
    public function __construct(string $message = "user_not_found", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}