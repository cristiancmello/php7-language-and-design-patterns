<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    /**
     * @var UuidInterface
     */
    private $userId;

    /**
     * UserId constructor.
     *
     * @param UuidInterface $userId
     */
    public function __construct(UuidInterface $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Retornar um novo Uuid a partir de uma string.
     *
     * @param UuidInterface $userId
     * @return UserId
     */
    public static function createFromString(UuidInterface $userId): UserId
    {
        return new self(Uuid::fromString($userId));
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->userId->toString();
    }
}