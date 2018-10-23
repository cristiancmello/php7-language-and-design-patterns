<?php

namespace DesignPatterns\Structural\Mediator;

class Database extends Colleague
{
    public function getData(): string
    {
        return 'World';
    }
}