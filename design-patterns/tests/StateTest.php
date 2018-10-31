<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Behavioral\State\OrderContext;

class StateTest extends TestCase
{
    public function testIsCreatedWithStateCreated()
    {
        $orderContext = OrderContext::create();

        $this->assertEquals('created', (string) $orderContext);
    }

    public function testCanProceedToStateShipped()
    {
        $orderContext = OrderContext::create();
        $orderContext->proceedToNext();

        $this->assertEquals('shipped', (string) $orderContext);
    }

    public function testCanProceedToStateDone()
    {
        $orderContext = OrderContext::create();
        $orderContext->proceedToNext();
        $orderContext->proceedToNext();

        $this->assertEquals('done', (string) $orderContext);
    }

    public function testStateDoneIsTheLastPossibleState()
    {
        $orderContext = OrderContext::create();
        $orderContext->proceedToNext();
        $orderContext->proceedToNext();
        $orderContext->proceedToNext();

        $this->assertEquals('done', (string) $orderContext);
    }
}