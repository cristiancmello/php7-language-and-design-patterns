<?php

// OOP
// Uma classe pode conter: constant, variáveis (ou propriedades) e funções (chamadas de métodos)

// Exemplo 1: Definição simples de classe
class SimpleClass
{
    // Declaração de propriedade
    public $var = 'default value';

    // Declaração de método
    public function displayVar()
    {
        echo $this->var . "\n";
    }
}

/*
    PSEUDO-VARIÁVEL $this
    Está disponível quando um método é chamado a partir do contexto de objeto.
    É uma referência ao objeto chamado.
 */

// Operador `new`
// Permite criar uma instância de uma classe.
/* REGRAS IMPORTANTES:
    (*) Se o construtor disparar uma EXCEPTION, o objeto NÃO SERÁ CRIADO
    (*) Classes devem ser definidas ANTES das instâncias
 */

// Exemplo 2: Criando uma instância
$instance = new SimpleClass();

// Podemos utilizar variáveis com string que contém o nome
$className = 'SimpleClass';
$instance = new $className(); // equivale a `new SimpleClass()`

// Exemplo 3: Atribuição de objetos
// O exemplo abaixo demonstra 2 casos.
// (1) Podemos usar referência para manipular a instância referenciada
// (2) Podemos clonar o objeto usando atribuição `=`

$instance = new SimpleClass();

$assigned = $instance;   // clonagem por atribuição
$reference =& $instance; // referenciação

$instance->var = '$assigned terá esse valor';

$instance = null; // agora, tanto $reference quanto $instance tornam-se nulos

var_dump($instance);    // NULL
var_dump($reference);   // NULL
var_dump($assigned);    // class SimpleClass#1 (1) { public $var => ... }

// Exemplo 4: Outras formas de criação de objetos
class Test
{
    static public function getNew()
    {
        return new static;
    }
}

class Child extends Test 
{

}

$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2); // bool(true) => quer dizer, $obj1 não é idêntico a $obj2 com o uso de new para $obj2

$obj3 = Test::getNew();
var_dump($obj3 instanceof Test); // bool(true)

$obj4 = Child::getNew();
var_dump($obj4 instanceof Child); // bool(true)


// Exemplo 5: Chamada a uma função anônima armazenada a uma propriedade
class Foo
{
    public $bar; // NÃO É POSSÍVEL ATRIBUIR FUNÇÃO ANÔNIMA AQUI

    public function __construct()
    {
        $this->bar = function () {
            return 42;
        };
    }
}

$obj = new Foo();
$func = $obj->bar;
echo $func() . "\n";       // 42

// Forma de chamada equivalente a de cima
echo ($obj->bar)() . "\n"; // 42

// Herança
// É promovida com uso da palavra `extends`.
// Uma classe pode herdar propriedades e métodos de outra classe.
// EM PHP, NÃO EXISTE HERANÇA MÚLTIPLA.

// OVERRIDE
// Em PHP, é possível sobrescrever (isto é, sobrepor) métodos e propriedades da classe de base.

// Exemplo 6: Herança simples com OVERRIDE ao método displayVar()
// Podemos usar a palavra `parent` para acessar membros da classe pai
class ExtendedCLass extends SimpleClass
{
    // Redefinição do método do pai
    function displayVar()
    {
        echo 'Classe herdeira' . "\n";
        parent::displayVar(); // default value
    }
}

$extended = new ExtendedClass();
$extended->displayVar(); // Classe herdeira

// Exemplo 7: Uso da palavra `final` para impedir que métodos sofram override
class ClassA
{
    public final function method()
    {
        echo "Não serei sobrescrito.\n";
    }
}

class ExtentedClassA extends ClassA
{
    // Se o método abaixo for descomentado, irá provocar um PHP Fatal error
    // public function method()
    // {
    //     echo "Sobrescrito.\n";
    // }
}