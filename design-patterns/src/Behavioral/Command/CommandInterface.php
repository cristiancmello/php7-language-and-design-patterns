<?php

namespace DesignPatterns\Behavioral\Command;

interface CommandInterface
{
    /**
     * Este é o método mais importante no padrão Command.
     * @return mixed
     */
    public function execute();
}
