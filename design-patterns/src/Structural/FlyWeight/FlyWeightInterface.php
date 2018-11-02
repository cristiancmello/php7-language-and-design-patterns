<?php

namespace DesignPatterns\Structural\FlyWeight;

interface FlyWeightInterface
{
    public function render(string $extrinsicState): string;
}
