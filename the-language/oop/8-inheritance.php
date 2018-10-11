<?php

declare(strict_types=1); // exemplo para forçar tipagem forte

// INHERITANCE
// Herança é um conceito bem estabelecido no modelo de programação orientada a objeto.
// Ao estender uma classe, a subclasse herda todos os métodos públicos e protegidos da classe pai.
// A subclasse manterá todos os métodos da classe pai, exceto quando ocorre override nos mesmos.

// IMPORTANTES
// As classes filhas devem ser declaradas após a classe pai. A não ser que o autoload seja usado,
// as classes devem ser definidas antes de utilizadas.

// Exemplo 1: Exemplo de herança
class Foo
{
    public function printItem(string $string): void
    {
        echo "Foo: $string.\n";
    }

    public function printPHP()
    {
        echo "PHP is great.\n";
    }
}

// Bar é filha de Foo
class Bar extends Foo
{
    public function printItem(string $string): void
    {
        echo "Bar: $string.\n";
    }
}

$foo = new Foo();
$bar = new Bar();

$foo->printItem('baz'); // Foo: baz.
$foo->printPHP();       // PHP is great.

$bar->printItem('baz'); // Bar: baz.
$bar->printPHP();       // PHP is great.