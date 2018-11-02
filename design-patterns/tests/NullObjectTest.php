<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Behavioral\NullObject\Service;
use DesignPatterns\Behavioral\NullObject\NullLogger;
use DesignPatterns\Behavioral\NullObject\PrintLogger;

class NullObjectTest extends TestCase
{
    public function testNullObject()
    {
        $service = new Service(new NullLogger());

        $this->expectOutputString('');
        $service->doSomething();
    }

    public function testStandardLogger()
    {
        $service = new Service(new PrintLogger());

        $this->expectOutputString('We are in DesignPatterns\Behavioral\NullObject\Service::doSomething');
        $service->doSomething();
    }
}
