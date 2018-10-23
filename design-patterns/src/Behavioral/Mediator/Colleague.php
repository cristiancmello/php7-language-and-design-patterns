<?php

namespace DesignPatterns\Structural\Mediator;

abstract class Colleague
{
    /**
     * @var Mediator
     */
    protected $mediator;

    /**
     * @param MediatorInterface $mediator
     */
    public function setMediator(MediatorInterface $mediator): void
    {
        $this->mediator = $mediator;
    }
}