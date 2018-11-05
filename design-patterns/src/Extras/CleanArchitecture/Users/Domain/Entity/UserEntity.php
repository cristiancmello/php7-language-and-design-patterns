<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Email;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Name;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Password;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Surname;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;

final class UserEntity
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Surname
     */
    private $surname;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var Password
     */
    private $password;

    /**
     * UserEntity constructor.
     *
     * @param UserId $userId
     * @param Name $name
     * @param Surname $surname
     * @param Email $email
     * @param Password $password
     */
    public function __construct(UserId $userId, Name $name, Surname $surname, Email $email, Password $password)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Atualiza dados do usuário.
     *
     * @param Name $name
     * @param Surname $surname
     * @param Email $email
     * @param Password $password
     */
    public function update(Name $name, Surname $surname, Email $email, Password $password): void
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Obtém senha do usuário.
     *
     * @return Password
     */
    public function password(): Password
    {
        return $this->password;
    }
}