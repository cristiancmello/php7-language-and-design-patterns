<?php

namespace DesignPatterns\Extras\Repository\Domain;

/**
 * Class PostId
 *
 * Esta classe evidencia que um valor de um objeto é identificável apenas pelo seu valor e é garantida
 * que toda instância criada tem esse valor como algo sempre válido.
 *
 * Um dos pontos importantes desta classe que um id é imutável. Não há formas de alterar o valor externamente.
 *
 * @package DesignPatterns\Extras\Repository\Domain
 */
class PostId
{
    /**
     * @var int
     */
    private $id;

    /**
     * Named constructor fromInt($id)
     *
     * É um construtor nomeado como fromInt de acesso público. É a alternativa que deve ser usada, pois
     * o construtor padrão foi declarado como privado.
     *
     * @param int $id
     * @return PostId
     */
    public static function fromInt(int $id)
    {
        self::ensureIsValid($id);

        return new self($id);
    }

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public function toInt(): int
    {
        return $this->id;
    }

    private static function ensureIsValid(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('Invalid PostId given');
        }
    }
}