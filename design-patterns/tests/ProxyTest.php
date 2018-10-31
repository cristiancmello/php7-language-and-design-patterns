<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Proxy\BankAccountProxy;

class ProxyTest extends TestCase
{
    public function testProxyWillOnlyExecuteExpensiveGetBalanceOnce()
    {
        $bankAccount = new BankAccountProxy();
        $bankAccount->deposit(30);

        $this->assertSame(30, $bankAccount->getBalance());

        $bankAccount->deposit(50);

        // Atestar que o saldo não será atualizado pois o proxy não provoca o recálculo
        $this->assertSame(30, $bankAccount->getBalance());
    }
}