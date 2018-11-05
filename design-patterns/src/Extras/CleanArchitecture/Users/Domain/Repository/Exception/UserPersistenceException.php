<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception;

class UserPersistenceException extends \Exception
{
    public function __construct(string $message = "user_persistence_error", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}