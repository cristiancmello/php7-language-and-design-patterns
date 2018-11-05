<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Collection\UsersArrayCollection;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity\UserEntity;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    /**
     * Retorna uma coleção de todos os usuários salvos para persistência.
     *
     * @return UsersArrayCollection
     *
     * @throws UserPersistenceException
     */
    public function all(): UsersArrayCollection;

    /**
     * Retorna um User por meio de um UserId.
     *
     * @param UserId $userId
     *
     * @return UserEntity
     *
     * @throws UserNotFoundException
     * @throws UserPersistenceException
     */
    public function getByUserId(UserId $userId): UserEntity;

    /**
     * Adicionar um novo usuário.
     *
     * @param UserEntity $user
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function add(UserEntity $user): void;

    /**
     * Retorna um próximo Userid válido.
     *
     * @return UserId
     *
     * @throws UserPersistenceException
     */
    public function nextId(): UserId;

    /**
     * Retorna true|false caso o usuário procurado por UserId exista.
     *
     * @param UserId $userId
     *
     * @return bool
     *
     * @throws UserPersistenceException
     */
    public function findByUserId(UserId $userId): bool;

    /**
     * Deletar User por meio de UserId
     *
     * @param UserId $userId
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function deleteByUserId(UserId $userId): void;

    /**
     * Atualiza User.
     *
     * @param UserEntity $user
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function update(UserEntity $user): void;
}