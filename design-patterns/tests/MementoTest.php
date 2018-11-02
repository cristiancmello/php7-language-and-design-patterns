<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Behavioral\Memento\Ticket;
use DesignPatterns\Behavioral\Memento\Memento;
use DesignPatterns\Behavioral\Memento\State;

class MementoTest extends TestCase
{
    public function testOpenTicketAssignAndSetBackToOpen()
    {
        $ticket = new Ticket();

        // Abre um ticket
        $ticket->open();
        $openedState = $ticket->getState(); // $openedTicket é uma referência ao objeto de estado do ticket

        $this->assertEquals(State::STATE_OPENED, (string) $ticket->getState());

        // Obter um snapshot do objeto $ticket, salvo no memento
        // O snapshot é um clone do ticket em seu atual estado. Logo, não é uma referência.
        $memento = $ticket->saveToMemento();

        // Atribui o ticket
        $ticket->assign();
        $this->assertEquals(State::STATE_ASSIGNED, (string) $ticket->getState());

        // Restaura um estado de ticket de acordo com o snapshot salvo
        $ticket->restoreFromMemento($memento);

        // Verifica se, após a restauração, o estado de ticket voltou ao inicial (de abertura)
        $this->assertEquals(State::STATE_OPENED, $ticket->getState());

        // Verifica se $openedState não é o mesmo que o objeto do estado atual do ticket
        // Eles não devem ser os mesmos, pois $openedState é uma referência a um objeto de estado
        // que representou ticket, enquanto este é um clone após a operação restoreFromMemento()
        $this->assertNotSame($openedState, $ticket->getState());
    }
}
