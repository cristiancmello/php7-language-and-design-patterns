<?php

namespace DesignPatterns\Behavioral\TemplateMethod;

abstract class Journey
{
    /**
     * @var string[]
     */
    private $thingsToDo = [];

    /**
     * Este método estabelece o processo "universal" da uma viagem. Não importa
     * o que se implementa em cada etapa, elas sempre serão chamadas.
     *
     * Se deseja fazer override deste contrato, monte uma interface somente com a assinatura `takeATrip()` e
     * uma subclasse que a implemente.
     */
    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takePlane();
        $this->thingsToDo[] = $this->enjoyVacation();
        $buyGift = $this->buyGift();

        if ($buyGift !== null) {
            $this->thingsToDo[] = $buyGift;
        }

        $this->thingsToDo[] = $this->takePlane();
    }

    /**
     * Este método DEVE ser implementado, o que satisfaz a característica-chave deste padrão.
     * Isso significa que toda classe de viagem deve implementar `enjoyVacation()` por conta própria.
     */
    abstract protected function enjoyVacation(): string;

    /**
     * Este método é também parte do algoritmo mas é opcional. Logo, é possível fazer
     * override caso seja necessário.
     *
     * @return null|string
     */
    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight(): string
    {
        return 'Buy a flight ticket';
    }

    private function takePlane(): string
    {
        return 'Taking the plane';
    }

    /**
     * @return string[]
     */
    public function getThingsToDo(): array
    {
        return $this->thingsToDo;
    }
}
