<?php

namespace DesignPatterns\Behavioral\State;

class OrderContext
{
    /**
     * @var State
     */
    private $state;

    public static function create(): OrderContext
    {
        $order = new self();
        $order->state = new StateCreated();

        return $order;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->proceedToNext($this);
    }

    public function __toString()
    {
        return (string) $this->state;
    }
}