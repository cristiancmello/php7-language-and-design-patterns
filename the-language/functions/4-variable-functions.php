<?php

// Variable Functions
// O PHP suporta o conceito de funções variáveis.
function foo() {
    echo "foo" . "\n";
}

$foo = 'foo'; // nome da função que será procurada é 'foo'
$foo(); // foo

function bar($string) {
    echo $string . "\n";
}

$bar = 'bar';
$bar('Hello, World!'); // Hello, World!

// Chamada de método variável
class Foo {
    function variableMethod() 
    {
        $name = 'Bar';
        $this->$name(); // vai chamar método com nome 'Bar'
    }

    function Bar() 
    {
        echo 'Bar()' . "\n";
    }
}

(new Foo)->variableMethod(); // Bar

// Método variável com propriedades estáticas
class Bar {
    static $variables = 'static property';

    static function Variable() 
    {
        echo 'Method Variable called.' . "\n";
    }
}

echo Bar::$variables . "\n"; // static property
$variables = 'Variable'; // define função estática a ser chamada
Bar::$variables(); // Method variable called

// Callables complexos
class SomeClass 
{
    static function bar() 
    {
        echo 'bar()' . "\n";
    }

    function foo() 
    {
        echo 'foo()' . "\n";
    }
}

$func = ['SomeClass', 'bar']; // define-se a nome da Classe e em seguida o método estático a ser chamado
$func(); // bar()

$func = [new SomeClass, 'foo']; // define-se a instanciação de uma classe e em seguida o método do objeto criado
$func(); // foo()

// String de chamada a um método estático
$func = 'SomeClass::bar';
$func(); // bar()