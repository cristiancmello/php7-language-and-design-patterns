<?php

namespace DesignPatterns\Behavioral\Memento;

class Memento
{
    /**
     * @var State
     */
    private $state;

    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }
}