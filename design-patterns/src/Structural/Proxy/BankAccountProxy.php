<?php

namespace DesignPatterns\Structural\Proxy;

class BankAccountProxy extends HeavyBankAccount implements BankAccount
{
    /**
     * @var int
     */
    private $balance;

    public function getBalance(): int
    {
        // Obter o saldo da conta é muito custo, porque vai requerer o cálculo
        // com base em todas as transações já feitas. Logo, se um pedido de saldo
        // já foi feito, não recalcule novamente.
        if ($this->balance === null) {
            $this->balance = parent::getBalance();
        }

        return $this->balance;
    }
}