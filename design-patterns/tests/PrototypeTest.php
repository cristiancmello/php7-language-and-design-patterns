<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Creational\Prototype\FooBookPrototype;
use DesignPatterns\Creational\Prototype\BarBookPrototype;

class PrototypeTest extends TestCase
{
    public function testCanGetFooBook()
    {
        $fooPrototype = new FooBookPrototype();
        $barPrototype = new BarBookPrototype();

        for ($i = 0; $i < 5; $i++) {
            $book = clone $fooPrototype;
            $book->setTitle("Foo Book Number $i");
            $this->assertInstanceOf(FooBookPrototype::class, $book);
        }

        for ($i = 0; $i < 5; $i++) {
            $book = clone $barPrototype;
            $book->setTitle("Bar Book Number $i");
            $this->assertInstanceOf(BarBookPrototype::class, $book);
        }
    }
}