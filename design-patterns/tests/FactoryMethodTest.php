<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Creational\FactoryMethod\StdoutLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\StdoutLogger;
use DesignPatterns\Creational\FactoryMethod\FileLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\FileLogger;

class FactoryMethodTest extends TestCase
{
    public function testCanCreateStdoutLogging()
    {
        $loggerFactory = new StdoutLoggerFactory();
        $logger = $loggerFactory->createLogger();

        $this->assertInstanceOf(StdoutLogger::class, $logger);
    }

    public function testCanStdoutLoggerWriteInStdout()
    {
        $loggerFactory = new StdoutLoggerFactory();
        $logger = $loggerFactory->createLogger();

        $this->expectOutputString("Hello World");
        $logger->log('Hello World');
    }

    public function testCanCreateFileLogging()
    {
        // sys_get_temp_dir() retorna '/tmp'
        $loggerFactory = new FileLoggerFactory(sys_get_temp_dir());
        $logger = $loggerFactory->createLogger();

        $this->assertInstanceOf(FileLogger::class, $logger);
    }

    public function testCanFileLoggerWriteInFile()
    {
        $filePath = sys_get_temp_dir() . '/test.txt';
        $loggerFactory = new FileLoggerFactory($filePath);
        $logger = $loggerFactory->createLogger();

        $logger->log('Hello World');
        $this->assertStringMatchesFormatFile($filePath, "Hello World\n");
    }
}
