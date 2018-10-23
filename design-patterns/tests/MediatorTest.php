<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Mediator\Client;
use DesignPatterns\Structural\Mediator\Server;
use DesignPatterns\Structural\Mediator\Mediator;
use DesignPatterns\Structural\Mediator\Database;

class MediatorTest extends TestCase
{
    public function testOutputHelloWorld()
    {
        $client = new Client();
        (new Mediator(new Database(), $client, new Server()));

        $this->expectOutputString('Hello World');
        $client->request();
    }
}