<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Bridge\HelloWorldService;
use DesignPatterns\Structural\Bridge\PlainTextFormatter;
use DesignPatterns\Structural\Bridge\HtmlFormatter;

class BridgeTest extends TestCase
{
    public function testCanPrintUsingThePlainTextFormatter()
    {
        $service = new HelloWorldService(new PlainTextFormatter());
        $this->assertEquals('Hello World!', $service->get('Hello World!'));
    }

    public function testCanPrintHtmlUsingPlainTextFormatter()
    {
        $service = new HelloWorldService(new PlainTextFormatter());

        // Mudar a implementação de formatador, graças ao padrão Bridge
        $service->setImplementation(new HtmlFormatter());
        $this->assertEquals('<p>Hello World!</p>', $service->get('Hello World!'));
    }
}