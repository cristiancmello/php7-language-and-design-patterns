<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\Strategy;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Name;
use Zend\Hydrator\Strategy\StrategyInterface;

final class NameStrategy implements StrategyInterface
{
    /**
     * Retorna uma string de um Name.
     *
     * @param mixed $name
     * @return mixed|string
     */
    public function extract($name): string
    {
        if (!$name instanceof Name) {
            throw new \InvalidArgumentException(get_class($name) . " must be an Name instance.");
        }
        
        return $name->getValue();
    }

    /**
     * Retorna um Name a partir de uma string.
     *
     * @param mixed $name
     * @return Name
     */
    public function hydrate($name): Name
    {
        return new Name($name);
    }
}