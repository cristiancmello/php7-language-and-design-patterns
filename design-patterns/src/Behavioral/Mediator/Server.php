<?php

namespace DesignPatterns\Structural\Mediator;

class Server extends Colleague
{
    public function process()
    {
        $data = $this->mediator->queryDb();
        $this->mediator->sendResponse(sprintf('Hello %s', $data));
    }
}
