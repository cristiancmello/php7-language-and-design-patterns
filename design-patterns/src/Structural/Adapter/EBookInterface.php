<?php

namespace DesignPatterns\Structural\Adapter;

// Assim como a Interface BookInterface, um ebook pode ter uma Interface com seus métodos
// próprios do seu tipo de interface
interface EBookInterface
{
    public function unlock();

    public function pressNext();

    public function getPage(): array;
}
