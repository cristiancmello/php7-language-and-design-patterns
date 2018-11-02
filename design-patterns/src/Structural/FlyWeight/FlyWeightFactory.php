<?php

namespace DesignPatterns\Structural\FlyWeight;

class FlyWeightFactory implements \Countable
{
    /**
     * @var CharacterFlyWeight[]
     */
    private $pool = [];

    public function get(string $name): CharacterFlyWeight
    {
        if (!isset($this->pool[$name])) {
            $this->pool[$name] = new CharacterFlyWeight($name);
        }

        return $this->pool[$name];
    }

    public function count(): int
    {
        return count($this->pool);
    }
}
