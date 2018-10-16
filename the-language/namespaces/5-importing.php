<?php

// USING NAMESPACES: ALIASING/IMPORTING
// Em PHP, podemos importar namespaces e apelidados para facilitar referenciação.

// Para mais exemplos: <https://secure.php.net/manual/en/language.namespaces.importing.php>

include 'the-language/namespaces/Person.php';

// Definir o uso de entidades com nome parcialmente qualificado
use My\Person\TypeA;

// Definir o uso com Classe global
use ArrayObject; // ArrayObject é padrão global em PHP

// Definir o uso com um apelido (alias)
use My\Person\TypeA\Person as PersonA;
use My\Person\TypeB\Person as PersonB;

// Importando uma função
use function My\Person\TypeA\myFunction;

// Importando uma função e a apelidando
use function My\Person\TypeA\myFunction as myFunc;

// Importando uma constante
use const My\Person\TypeA\MY_CONST;

// Instanciando classes com apelidos
$person = new PersonA();
$person = new PersonB();

myFunction(); // função importada
myFunc();     // função importada apelidada

echo MY_CONST . "\n"; // 1