<?php

namespace DesignPatterns\Structural\DataMapper;

class UserMapper
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById(int $id): User
    {
        $result = $this->adapter->find($id);

        if ($result === null) {
            throw new \InvalidArgumentException("User #$id not found.");
        }

        return $this->mapRowToUser($result);
    }

    public function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}