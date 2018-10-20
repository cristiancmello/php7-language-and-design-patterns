<?php

namespace DesignPatterns\Behavioral\Command;

class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;

    public function setCommand(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function run()
    {
        $this->command->execute();
    }
}