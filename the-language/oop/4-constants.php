<?php

// CONSTANTS
// É possível definir constantes em cada classe, permanecendo imutável.
// >>>> A visibilidade padrão é `public` <<<<

// Exemplo 1: Uso de constante
class MyClass
{
    const myConstant = 'const value';

    function showConst()
    {
        echo self::myConstant . "\n";
    }
}

echo MyClass::myConstant . "\n"; // const value

// Podemos referenciar uma classe e constante usando string com nome da classe
$myClass = 'MyClass';
echo $myClass::myConstant . "\n"; // const value


$class = new MyClass();
$class->showConst(); // const value

// Outra possibilidade equivalente
echo $class::myConstant . "\n"; // const value

// Exemplo 2: Uso do heredoc com const
class Foo
{
    const BAR = <<<'EOT'
bar
EOT;
}

// Expressão constante
// É possível expressar constantes com valores de strings e numéricos literais.
// Exemplo 3: Uso de expressões constantes
const ONE = 1;

class Bar
{
    const TWO = ONE * 2;
    const THREE = ONE + self::TWO;
    const SENTENCE = 'O valor de THREE é ' . self::THREE;
}

echo Bar::TWO . "\n";       // 2
echo Bar::THREE . "\n";     // 3
echo Bar::SENTENCE . "\n";  // O valor de THREE é 3

// Modificadores de visiblidade em constantes de classe
// Exemplo 4
class ClassA
{
    public const BAR = 'bar';
    private const BAZ = 'baz';
}

echo ClassA::BAR . "\n"; // bar
echo ClassA::BAZ . "\n"; // Será lançada uma exceção PHP Fatal error