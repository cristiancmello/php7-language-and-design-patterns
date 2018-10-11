<?php

// VISIBILITY
// Podemos definir a visibilidade de propriedades e métodos prefixando a declaração
// com `private`, `public` ou `protected`

// `public`: podem ser acessados de qualquer lugar
// `protected`: só podem ser acessados na classe declarante e suas herdeiras
// `private`: só pode ser acessado na classe que define o membro privado

// Exemplo 1: declaração de propriedade
class MyClass
{
    public $public = 'Public';
    private $private = 'Private';
    protected $protected = 'Protected';

    function printHello()
    {
        echo "$this->public.\n";
        echo "$this->private.\n";
        echo "$this->protected.\n";
    }
}

$obj1 = new MyClass();
$obj1->printHello(); // Public.\nPrivate.\nṔrotected.\n

echo "$obj1->public.\n"; // Public.
// echo "$obj1->protected.\n"; => ERRO FATAL por acesso a propriedade protegida
// echo "$obj1->private.\n"; => ERRO FATAL por acesso a propriedade privada

// Exemplo 2: Podemos redeclarar propriedades protegidas e públicas somente
class MyExtendedClass extends MyClass
{
    protected $protected = 'Protected2';
    public $public = 'Public2';
}

(new MyExtendedClass())->printHello(); // Public2.\nPrivate.\nProtected2

// Visibilidade de métodos
// Exemplo 3: casos básicos
class MyClassA
{
    // Declara construtor como público
    public function __construct() { }
    
    // Declara método como público
    public function myPublic() { }

    // Declara método como protegido
    protected function myProtected() { }

    // Declara método como private
    private function myPrivate() { }

    // MÉTODO SEM EXPRESSÃO DE VISIBILIDADE É TRATADO IMPLICITAMENTE `public`
    function myImplicitlyPublic() { }
}

// Visibilidade de outros objetos
// OBJETOS DO MESMO TIPO TERÃO ACESSO A OUTROS MEMBROS PRIVADOS OU PROTEGIDOS MESMO
// QUE NÃO SEJAM DA MESMA INSTÂNCIA.
// ISSO OCORRE POR QUE OS DETALHES ESPECÍFICOS DE IMPLEMENTAÇÃO JÁ SÃO CONHECIDOS DENTRO DESSES OBJETOS
// Em resumo: SE FOR DA MESMA "LINHAGEM", PODEMOS MUDAR SEM PROBLEMAS

// Exemplo 4
class Test
{
    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    private function bar()
    {
        echo "Acessou método privado.\n";
    }

    public function baz(Test $other)
    {
        $other->foo = 'hello';
        var_dump($other->foo);

        // Pode-se chamar método privado de outro objeto da mesma classe
        $other->bar();
    }
}

$test = new Test('test');
$test->baz(new Test('other'));

/*
string(5) "hello"
Acessou método privado.
 */