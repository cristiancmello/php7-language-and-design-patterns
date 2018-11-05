<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\Strategy;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Surname;
use Zend\Hydrator\Strategy\StrategyInterface;

final class SurnameStrategy implements StrategyInterface
{
    /**
     * Retorna uma string de um Surname.
     *
     * @param mixed $surname
     * @return mixed|string
     */
    public function extract($surname): string
    {
        if (!$surname instanceof Surname) {
            throw new \InvalidArgumentException(get_class($surname) . " must be an Surname instance.");
        }
        
        return $surname->getValue();
    }

    /**
     * Retorna um Surname a partir de uma string.
     *
     * @param mixed $surname
     * @return Surname
     */
    public function hydrate($surname): Surname
    {
        return new Surname($surname);
    }
}