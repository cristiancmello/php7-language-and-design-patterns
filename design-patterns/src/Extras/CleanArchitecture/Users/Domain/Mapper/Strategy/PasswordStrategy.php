<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\Strategy;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Password;
use Zend\Hydrator\Strategy\StrategyInterface;

final class PasswordStrategy implements StrategyInterface
{
    /**
     * Retorna uma string de um Password.
     *
     * @param mixed $password
     * @return mixed|string
     */
    public function extract($password): string
    {
        if (!$password instanceof Password) {
            throw new \InvalidArgumentException(get_class($password) . " must be an Password instance.");
        }
        
        return $password->getValue();
    }

    /**
     * Retorna um Password a partir de uma string.
     *
     * @param mixed $password
     * @return Password
     */
    public function hydrate($password): Password
    {
        return Password::createFromHashedPassword($password);
    }
}