<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects;

final class Password
{
    /**
     * @var string
     */
    private $password;

    /**
     * Password constructor.
     *
     * @param string $password
     */
    public function __construct(string $password)
    {
        if (strlen($password) < 6) {
            throw new \InvalidArgumentException('Password must be longer than 6 char.');
        }

        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Criar um Password com base num valor de objeto de Hash.
     *
     * @param string $password
     *
     * @return Password
     */
    public static function createFromHashedPassword(string $password): Password
    {
        $self = unserialize(sprintf('O:%u:"%s":0:{}', strlen(self::class), self::class));
        $self->password = $password;

        return $self;
    }

    /**
     * Verifica se a senha é válida ou não.
     *
     * @param string $password
     * @return bool
     */
    public function checkValidity(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * Retorna o valor de objeto da senha criada.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->password;
    }
}