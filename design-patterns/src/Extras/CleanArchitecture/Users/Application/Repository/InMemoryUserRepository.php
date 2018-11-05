<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Application\Repository;

use Damianopetrungaro\CleanArchitecture\Mapper\Mapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Collection\UsersArrayCollection;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity\UserEntity;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\UserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserNotFoundException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\UserRepositoryInterface;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;
use Ramsey\Uuid\Uuid;

final class InMemoryUserRepository implements UserRepositoryInterface
{
    /**
     * @var UsersArrayCollection
     */
    private $data;

    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param UserMapper $mapper
     */
    public function __construct(UserMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Retorna uma coleção de todos os usuários salvos para persistência.
     *
     * @return UsersArrayCollection
     *
     * @throws UserPersistenceException
     */
    public function all(): UsersArrayCollection
    {
        // TODO: Implement all() method.
    }

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
    public function getByUserId(UserId $userId): UserEntity
    {
        // TODO: Implement getByUserId() method.
    }

    /**
     * Adicionar um novo usuário.
     *
     * @param UserEntity $user
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function add(UserEntity $user): void
    {
        $user = $this->mapper->toArray($user);

        $this->data[] = $user;
    }

    /**
     * Retorna um próximo Userid válido.
     *
     * @return UserId
     *
     * @throws UserPersistenceException
     * @throws \Exception
     */
    public function nextId(): UserId
    {
        return new UserId(Uuid::uuid1());
    }

    /**
     * Retorna true|false caso o usuário procurado por UserId exista.
     *
     * @param UserId $userId
     *
     * @return bool
     *
     * @throws UserPersistenceException
     */
    public function findByUserId(UserId $userId): bool
    {
        // TODO: Implement findByUserId() method.
    }

    /**
     * Deletar User por meio de UserId
     *
     * @param UserId $userId
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function deleteByUserId(UserId $userId): void
    {
        // TODO: Implement deleteByUserId() method.
    }

    /**
     * Atualiza User.
     *
     * @param UserEntity $user
     *
     * @return void
     *
     * @throws UserPersistenceException
     */
    public function update(UserEntity $user): void
    {
        // TODO: Implement update() method.
    }
}