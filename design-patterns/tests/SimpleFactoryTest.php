<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Creational\SimpleFactory\SimpleFactory;
use DesignPatterns\Creational\SimpleFactory\Bicycle;

class SimpleFactoryTest extends TestCase
{
    public function testCanCreateBicycle()
    {
        $bicyle = (new SimpleFactory())->createBicycle();
        $this->assertInstanceOf(Bicycle::class, $bicyle);
    }

    public function testCanDriveToSomewhere()
    {
        $bicycle = (new SimpleFactory())->createBicycle();

        $this->expectOutputString('Going to England');
        $bicycle->driveTo('England');
    }
}
