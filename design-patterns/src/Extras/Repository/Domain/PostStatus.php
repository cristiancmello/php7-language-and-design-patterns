<?php

namespace DesignPatterns\Extras\Repository\Domain;

class PostStatus
{
    const STATE_DRAFT_ID = 1;
    const STATE_PUBLISHED_ID = 2;

    const STATE_DRAFT = 'draft';
    const STATE_PUBLISHED = 'published';

    private static $validStates = [
        self::STATE_DRAFT_ID => self::STATE_DRAFT,
        self::STATE_PUBLISHED_ID => self::STATE_PUBLISHED,
    ];

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    public static function fromInt(int $statusId)
    {
        self::ensureIsValidId($statusId);

        return new self($statusId, self::$validStates[$statusId]);
    }

    public static function fromString(string $status)
    {
        self::ensureIsValidName($status);

        return new self(array_search($status, self::$validStates), $status);
    }

    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function toInt(): int
    {
        return $this->id;
    }

    /**
     * Tradicionamente se usa __toString(). No entanto, em PHP esse método não opera muito bem
     * com lançamento de exceções. Assim, forçamos um método próprio semelhante ao __toString().
     */
    public function toString(): string
    {
        return $this->name;
    }

    private static function ensureIsValidId(int $status)
    {
        if (!in_array($status, array_keys(self::$validStates), true)) {
            throw new \InvalidArgumentException('Invalid status id given');
        }
    }

    private static function ensureIsValidName(string $status)
    {
        if (!in_array($status, self::$validStates, true)) {
            throw new \InvalidArgumentException('Invalid status name given');
        }
    }
}