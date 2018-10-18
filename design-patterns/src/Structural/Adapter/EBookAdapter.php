<?php

namespace DesignPatterns\Structural\Adapter;

class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    protected $eBook;

    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    public function open()
    {
        $this->eBook->unlock();
    }

    /**
     * Aviso: EBookInterface::getPage() retorna um array com 2 integers. No entanto,
     * BookInterface suporta somente apenas 1 integer de página corrente. Precisamos adaptar.
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}