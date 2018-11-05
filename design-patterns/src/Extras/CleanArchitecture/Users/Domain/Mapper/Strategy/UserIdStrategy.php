<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\Strategy;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;
use Zend\Hydrator\Strategy\StrategyInterface;

final class UserIdStrategy implements StrategyInterface
{
    /**
     * Retorna uma string de um UserId.
     *
     * @param mixed $userId
     * @return mixed|string
     */
    public function extract($userId)
    {
        if (!$userId instanceof UserId) {
            throw new \InvalidArgumentException(get_class($userId) . " must be an UserId instance");
        }
        
        return $userId->getValue();
    }

    /**
     * Retorna um UserId a partir de uma string.
     *
     * @param mixed $userId
     * @return UserId
     */
    public function hydrate($userId): UserId
    {
        return UserId::createFromString($userId);
    }
}