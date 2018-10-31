<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\FlyWeight\CharacterFlyWeight;
use DesignPatterns\Structural\FlyWeight\FlyWeightFactory;

class FlyWeightTest extends TestCase
{
    private $characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    private $fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];

    public function testFlyweight()
    {
        $factory = new FlyWeightFactory();

        foreach ($this->characters as $character) {
            foreach ($this->fonts as $font) {
                $flyweight = $factory->get($character);
                $rendered = $flyweight->render($font);

                $this->assertEquals(sprintf('Character %s with font %s', $character, $font), $rendered);
            }
        }

        $this->assertCount(count($this->characters), $factory);
    }
}