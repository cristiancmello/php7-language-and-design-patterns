<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Facade\OsInterface;
use DesignPatterns\Structural\Facade\BiosInterface;
use DesignPatterns\Structural\Facade\Facade;

class FacadeTest extends TestCase
{
    public function testComputerOn()
    {
        $os = $this->createMock(OsInterface::class);

        $os->method('getName')
            ->will($this->returnValue('Linux'));

        /** @var OsInterface|\PHPUnit_Framework_MockObject_MockObject $os */
        // getMockBuilder(): obter mock de bios baseado na interface BiosInterface
        $bios = $this->getMockBuilder(BiosInterface::class)
            ->setMethods(['launch', 'execute', 'waitForKeyPress'])
            ->disableAutoload()
            ->getMock();

        // Executar método launch apenas 1 vez com $os como parâmetro
        $bios->expects($this->once())
            ->method('launch')
            ->with($os);

        $facade = new Facade($bios, $os);

        $facade->turnOn();

        $this->assertEquals('Linux', $os->getName());
    }
}