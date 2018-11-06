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
     * @var array
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
        $this->data = [];
        $this->mapper = $mapper;
    }

    /**
     * Retorna uma coleção de todos os usuários salvos para persistência.
     *
     * @return UsersArrayCollection
     * @throws UserPersistenceException
     */
    public function all(): UsersArrayCollection
    {
        try {
            $users = $this->mapper->toMultipleObject(UserEntity::class, $this->data);
        } catch (\Exception $e) {
            throw new UserPersistenceException('impossible_get_users', $e->getCode(), $e);
        }

        return $users;
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
        try {
            $id = $this->searchByField('id', $userId->getValue());
        } catch (\Exception $e) {
            throw new UserPersistenceException('impossible_get_user', $e->getCode(), $e);
        }

        if ($id == -1) {
            throw new UserNotFoundException();
        }

        return $this->mapper->toObject(UserEntity::class, $this->data[$id]);
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
        try {
            $id = $this->searchByField('id', $userId->getValue());
        } catch (\Exception $e) {
            throw new UserPersistenceException('impossible_get_user', $e->getCode(), $e);
        }

        if ($id == -1) {
            return false;
        }

        return true;
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
        try {
            $id = $this->searchByField('id',$userId->getValue());

            unset($this->data[$id]);
            $this->data = array_values($this->data);
        } catch (\Exception $e) {
            throw new UserPersistenceException('impossible_delete_user', $e->getCode(), $e);
        }
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

    /**
     * @param $field
     * @param $value
     * @return int
     * @throws \Exception
     */
    private function searchByField($field, $value)
    {
        $count = 0;

        if (array_key_exists($field, $this->data)) {
            throw new \Exception("Field $field not found.");
        }

        foreach ($this->data as $user) {
            if ($user[$field] === $value) {
                return $count;
            }

            $count++;
        }

        return -1;
    }
}