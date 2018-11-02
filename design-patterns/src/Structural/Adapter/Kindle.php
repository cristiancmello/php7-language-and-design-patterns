<?php

namespace DesignPatterns\Structural\Adapter;

class Kindle implements EBookInterface
{
    private $page = 1;

    private $totalPages = 100;

    public function unlock()
    {
        // TODO: Implement unlock() method.
    }

    public function pressNext()
    {
        $this->page++;
    }

    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}
