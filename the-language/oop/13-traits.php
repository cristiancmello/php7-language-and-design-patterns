<?php

// TRAITS
// PHP implementa um método de reuso de código chamado Traits.
// (*) Permite ao desenvolvedor reduzir complexidades e evitar problemas típicos associados à herança múltipla
//     e Mixins.
// (*) Um trait é semelhante a uma classe, mas é focado num grupo de funcionalidades 
// (*) NÃO É POSSÍVEL INSTANCIAR UM TRAIT
// (*) Permite a composição de comportamentos numa determinada classe sem que seja preciso fazer herdá-la de outra classe

// Exemplo 1: Uso de trait para prover funcionalidade de Log a duas classes, User e ShoppingCart
trait Log
{
    public function log($message)
    {
        print("$message\n");
    }
}

class User
{
    use Log;

    public function save()
    {
        // ...código para salvar usuário
        $this->log("Created User");
    }
}

class ShoppingCart
{
    use Log;

    public function save()
    {
        $this->log("Created ShoppingCart");
    }
}

$user = new User();
$cart = new ShoppingCart();

$user->save();  // Created User
$cart->save();  // Cerated ShoppingCart

// Precedência
// O método do Trait sobrescreve o método herdado da classe base

// Exemplo 2: Exemplo de override feito por um trait
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    // O método abaixo sobrescreve o método sayHello
    public function sayHello() {
        parent::sayHello();
        echo 'World!' . "\n";
    }
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello(); // Hello World!

// Precedência alternada
// Podemos sobrescrever o método implementado num Trait

// Exemplo 3: Exemplo de override num método implementado por um trait
trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
}

class TheWorldIsNotEnough {
    use HelloWorld;
    public function sayHello() {
        echo 'Hello Universe!' . "\n";
    }
}

$o = new TheWorldIsNotEnough();
$o->sayHello(); // Hello Universe!

// Múltiplos Traits
// Podemos utilizar N traits numa classe.

// Exemplo 4: Exemplo de múltiplos traits
trait Hello 
{
    public function sayHello() 
    {
        echo 'Hello ';
    }
}

trait World 
{
    public function sayWorld() 
    {
        echo 'World';
    }
}

class MyHelloWorld2 
{
    use Hello, World;

    public function sayExclamationMark() 
    {
        echo '!' . "\n";
    }
}

$o = new MyHelloWorld2();
$o->sayHello();             // Hello
$o->sayWorld();             // World
$o->sayExclamationMark();   // !

// Resolução de Conflito
// Exemplo 5: Renomear e trocar nome de métodos que colidem no reuso
trait A
{
    public function smallTalk()
    {
        echo 'a';
    }

    public function bigTalk()
    {
        echo 'A';
    }
}

trait B
{
    public function smallTalk()
    {
        echo 'b';
    }

    public function bigTalk()
    {
        echo 'B';
    }
}

class Talker
{
    use A, B {
        B::smallTalk insteadof A; // B::smallTalk ao invés de A => troca implementação de smallTalk de A por B
        A::bigTalk insteadof B;   // A::bigTalk   ao invés de B => troca implementação de bigTalk de B por A
    }
}

class AliasedTalker
{
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;   // renomear bigTalk do Trait B para 'talk'
    }
}

$aliasedTalker = new AliasedTalker();

$aliasedTalker->bigTalk(); // A
$aliasedTalker->talk();    // B
echo "\n";

// Exemplo 6: Mudar Visibilidade de Métodos e renomear simultaneamente
class MyClassA
{
    use HelloWorld { sayHello as protected; }
}

class MyClassB
{
    use HelloWorld { sayHello as private myHelloWorld; }
}

// Traits compostos por Traits

// Exemplo 7: Podemos fazer composição de traits por traits
trait HelloWorldComposition
{
    use Hello, World;
}

class MyHelloWorld3
{
    use HelloWorldComposition;
}

// Membros abstratos
// Traits suportam membros abstratos para serem implementados em classes

// Exemplo 8: caso simples
trait HelloWorldWithAbstract
{
    abstract protected function getWorld();
}

class MyHelloWorld4
{
    use HelloWorldWithAbstract;

    public function getWorld()
    {
        echo "world\n";
    }
}

// Membros estáticos
// Traits suportam membros estáticos.

// Exemplo 9: contador com membros estáticos
trait Counter
{
    public function inc()
    {
        static $c = 0;
        $c++;

        echo "$c\n";
    }

    public static function doSomething()
    {
        echo "Doing something\n";
    }
}

class C1
{
    use Counter;
}

$o = new C1();
$o->inc();          // 1
$o->inc();          // 2
C1::doSomething();  // Doing something

// Propriedades
trait PropertiesTrait {
    public $x = 1;
    public $same = true;
    public $different = false;
}

class PropertiesExample {
    use PropertiesTrait;

    public $same = true; // Allowed as of PHP 7.0.0; E_STRICT notice formerly
    // public $different = true; // Fatal error, pois valor inicial é diferente do valor original do trait, que é $different = false
}

$example = new PropertiesExample;
echo $example->x . "\n";    // 1