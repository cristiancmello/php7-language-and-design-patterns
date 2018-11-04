<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects;

final class Email
{
    /**
     * @var string
     */
    private $email;

    public function __construct(string $email)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException('Email must be sent.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email '$email' is not valid email.");
        }

        if (strlen($email) > 255) {
            throw new \InvalidArgumentException("Email '$email' must be less than 255 chars.");
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->email;
    }
}