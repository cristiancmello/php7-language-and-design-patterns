<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Adapter\Book;
use DesignPatterns\Structural\Adapter\Kindle;
use DesignPatterns\Structural\Adapter\EBookAdapter;

class AdapterTest extends TestCase
{
    // Teste do caso de uso da criação de um livro "ideal"
    public function testCanTurnPageOnBook()
    {
        $book = new Book();

        $book->open();
        $book->turnPage();

        $this->assertSame(2, $book->getPage());
    }

    // Teste do caso de uso de criação de um livro do tipo ebook que precisa
    // ter o mesmo comportamento do livro "ideal", mas podendo ter
    // detalhes inerentes diferentes do livro "ideal"
    public function testCanTurnPageOnKindleLikeInANormalBook()
    {
        $kindle = new Kindle();
        $book = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();

        $this->assertSame(2, $book->getPage());
    }
}