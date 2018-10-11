<?php

// SCOPE RESOLUTION OPERATOR (`::`)
// É o operador de pontos duplos `::`.
// PERMITE ACESSO A MÉTODOS E PROPRIEDADES ESTÁTICAS, CONSTANTES E SOBRECARREGADAS de uma classe.

// Exemplo 1: Uso de `::` fora da definição de classe
class MyClass
{
    const CONST_VALUE = 'um valor constante';
}

$classname = 'MyClass';
echo $classname::CONST_VALUE . "\n"; // um valor constante
echo MyClass::CONST_VALUE . "\n";    // um valor constante

// Exemplo 2: uso das palavras `self`, `parent` e `static` para acessar propriedades
// e métodos dentro de uma definição de classe
class OtherClass extends MyClass
{
    public static $myStatic = 'variável estática';

    public static function doubleColon()
    {
        echo parent::CONST_VALUE . "\n";
        echo self::$myStatic . "\n";
    }
}

$classname = 'OtherClass';
echo $classname::doubleColon();

OtherClass::doubleColon();

/* 
um valor constante
variável estática
um valor constante
variável estática
 */