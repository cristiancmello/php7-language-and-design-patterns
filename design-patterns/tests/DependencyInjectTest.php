<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\DependecyInjection\DatabaseConfiguration;
use DesignPatterns\Structural\DependecyInjection\DatabaseConnection;

class DependencyInjectTest extends TestCase
{
    public function testDependencyInjection()
    {
        $config = new DatabaseConfiguration('localhost', 3306, 'johndoe', '123456');
        $connection = new DatabaseConnection($config);

        $this->assertEquals('johndoe:123456@localhost:3306', $connection->getDsn());
    }

    public function testConnectionWithMockableConfiguration()
    {
        $config = $this->createMock(DatabaseConfiguration::class);
        $config
            ->method('getHost')
            ->willReturn('localhost');

        $config
            ->method('getPort')
            ->willReturn(3306);

        $config
            ->method('getUsername')
            ->willReturn('johndoe');

        $config
            ->method('getPassword')
            ->willReturn('123456');

        // Fica muito versátil utilizar um objeto configurável desacoplado ao DatabaseConnection
        $connection = new DatabaseConnection($config);

        $this->assertEquals('johndoe:123456@localhost:3306', $connection->getDsn());
    }
}