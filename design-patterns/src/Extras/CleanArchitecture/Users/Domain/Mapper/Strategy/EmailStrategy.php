<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\Strategy;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Email;
use Zend\Hydrator\Strategy\StrategyInterface;

final class EmailStrategy implements StrategyInterface
{
    /**
     * Retorna uma string de um Email.
     *
     * @param mixed $email
     * @return mixed|string
     */
    public function extract($email): string
    {
        if (!$email instanceof Email) {
            throw new \InvalidArgumentException(get_class($email) . " must be an Email instance.");
        }
        
        return $email->getValue();
    }

    /**
     * Retorna um UserId a partir de uma string.
     *
     * @param mixed $email
     * @return Email
     */
    public function hydrate($email): Email
    {
        return new Email($email);
    }
}