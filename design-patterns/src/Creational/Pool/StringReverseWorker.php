<?php

namespace DesignPatterns\Creational\Pool;

class StringReverseWorker
{
    /**
     * @var \DateTime
     */
    private $createAt;

    public function __construct()
    {
        $this->createAt = new \DateTime();
    }

    public function run(string $text)
    {
        return strrev($text);
    }
}
