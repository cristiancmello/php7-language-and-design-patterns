<?php

use PHPUnit\Framework\TestCase;
use DesignPatterns\Behavioral\Command\Invoker;
use DesignPatterns\Behavioral\Command\Receiver;
use DesignPatterns\Behavioral\Command\HelloCommand;

class CommandTest extends TestCase
{
    public function testInvocation()
    {
        $invoker = new Invoker();
        $receiver = new Receiver();

        $invoker->setCommand(new HelloCommand($receiver));
        $invoker->run();

        $this->assertEquals('Hello World', $receiver->getOutput());

        $receiver->enableDate();
        $invoker->run();

        // Asserção a procura de um padrão de data registrada na execução do command
        $this->assertRegExp('/Hello\sWorld\s\[(\d+)(-)(\d+)(-)(\d+)\]/', $receiver->getOutput());
    }
}
