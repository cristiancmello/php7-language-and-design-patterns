<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects;

final class Name
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException("Name can't be empty.");
        }

        if (strlen($name) > 255) {
            throw new \InvalidArgumentException("Name '$name' must be less than 255 chars.");
        }

        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }
}