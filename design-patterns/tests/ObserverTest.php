<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Behavioral\Observer\User;
use DesignPatterns\Behavioral\Observer\UserObserver;

class ObserverTest extends TestCase
{
    /**
     * Teste para caso onde o usuário observador recebe notificação de alteração de um usuário.
     */
    public function testChangeInUserLeadsToUserObserverBeingNotified()
    {
        $observer = new UserObserver();

        $user = new User();
        $user->attach($observer);

        $user->changeEmail('foo@bar.com');
        $this->assertCount(1, $observer->getChangedUsers());
    }
}
