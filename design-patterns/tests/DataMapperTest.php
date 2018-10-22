<?php

use PHPUnit\Framework\TestCase;
use DesignPatterns\Structural\DataMapper\User;
use DesignPatterns\Structural\DataMapper\UserMapper;
use DesignPatterns\Structural\DataMapper\StorageAdapter;

class DataMapperTest extends TestCase
{
    public function testCanMapUserFromStorage()
    {
        $storage = new StorageAdapter(["1" => [
            'username' => 'John Doe',
            'email'    => 'john.doe@email.com'
        ]]);

        $mapper = new UserMapper($storage);
        $user = $mapper->findById("1");

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * A flag abaixo sinaliza uma asserção que captura uma Exception lançada.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testWillNotMapInvalidData()
    {
        $storage = new StorageAdapter([]);
        $mapper = new UserMapper($storage);

        $mapper->findById("1");
    }
}