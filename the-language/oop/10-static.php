<?php

// STATIC KEYWORD
// Membros estáticos podem ser chamados sem que a classe seja instanciada.
// Logo, a pseudo-variável $this não estará disponível.

// Exemplo 1: Exemplo de método estático
class Foo 
{
    public static function aStaticMethod()
    {
        echo "aStaticMethod()\n";
    }
}

Foo::aStaticMethod();           // aStaticMethod()
$classname = 'Foo';
$classname::aStaticMethod();    // aStaticMethod()

// Exemplo 2: Exemplo com propriedade estática
class MyClass
{
    public static $myStatic = 'myClass';

    public function staticValue()
    {
        return self::$myStatic;
    }
}

class MyExtendedClass extends MyClass
{
    public function myClassStatic()
    {
        return parent::$myStatic;
    }
}

print(MyClass::$myStatic . "\n");   // myClass

$obj = new MyClass();
print($obj->staticValue() . "\n");  // myClass
// print($obj->$myStatic . "\n");   // Propriedade indefinida pois é estática