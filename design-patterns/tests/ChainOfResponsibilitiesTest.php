<?php

use PHPUnit\Framework\TestCase;
use DesignPatterns\Behavioral\ChainOfResponsibilities\Handler;
use DesignPatterns\Behavioral\ChainOfResponsibilities\FastStorageHandler;
use DesignPatterns\Behavioral\ChainOfResponsibilities\SlowStorageHandler;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ChainOfResponsibilitiesTest extends TestCase
{
    /**
     * @var Handler
     */
    private $chainOfResponsibilities;

    protected function setUp()
    {
        $this->chainOfResponsibilities = new FastStorageHandler([
            '/foo/bar?index=1' => 'Hello In Memory!'
        ], new SlowStorageHandler());
    }

    public function testCanRequestKeyInFastStorage()
    {
        // Cria um esboço de classe baseado na Interface UriInterface do Guzzle
        $uri = $this->createMock('Psr\Http\Message\UriInterface');

        // Configura um esboço (stub)
        $uri
            ->method('getPath')
            ->willReturn('/foo/bar');

        $uri
            ->method('getQuery')
            ->willReturn('index=1');

        $request = $this->createMock('Psr\Http\Message\RequestInterface');
        $request
            ->method('getMethod')
            ->willReturn('GET');

        $request
            ->method('getUri')
            ->willReturn($uri);

        $this->assertEquals('Hello In Memory!', $this->chainOfResponsibilities->handle($request));
    }

    public function testCanRequestKeyInSlowStorage()
    {
        $uri = $this->createMock('Psr\Http\Message\UriInterface');
        $uri
            ->method('getPath')
            ->willReturn('/foo/baz');
        $uri
            ->method('getQuery')
            ->willReturn('');

        $request = $this->createMock('Psr\Http\Message\RequestInterface');
        $request
            ->method('getMethod')
            ->willReturn('GET');

        $request
            ->method('getUri')
            ->willReturn($uri);

        $this->assertEquals('Hello World!', $this->chainOfResponsibilities->handle($request));
    }
}