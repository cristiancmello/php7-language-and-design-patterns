<?php
// declare(strict_types=1);    // tornar rígida avaliação de tipos de variáveis passadas como parâmetro de funções

// Argumentos de funções
// Informações passadas para funções através de lista de argumentos.
// São avaliados da ESQUERDA PARA DIREITA

// PHP suporta:
// (*) PASSAGEM POR VALOR (padrão) e REFERÊNCIA;
// (*) PASSAGEM DE VALORES PADRÕES;
// (*) LISTA VARIÁVEL DE ARGUMENTOS.

// Passagem por REFERÊNCIA
function changeString(&$string) {
    $string = 'changed';
}

$name = 'John Doe';
changeString($name);
echo $name . "\n"; // changed

// Declarações de Tipo
// bool => tipo escalar aceitável. Alguns notáveis são array, callable, float, int, string e nomes de Classes/Interfaces
// Apelidos de tipos escalares não são aceitáveis. Apelidos são tratados como Classe ou Interface
function test(bool $test) {
    return $test;
}

echo test(true) . "\n"; // 1

function newTest(boolean $test) {
    return true;
}

// echo newTest(true); => PHP Fatal error:  Uncaught TypeError: Argument 1 passed to newTest() must be an instance of boolean, boolean given

// Declaração de tipos nulificáveis
class C { public $var = 'variable'; }

function f(C $c = null) {
    var_dump($c);
}

f(); // NULL
f(new C); // class C#1 (1) { public $var => ...}

// Tipagem Estrita
// Em PHP, é permitido tornar mais rígida a avaliação de tipos declarados nos parâmetros de funções.
// Isto é, o valor do argumento passado deve corresponder exatamente ao tipo declarado no parâmetro da função.
// declare(strict_types=1); => deve ser a primeira instrução do arquivo .php
function add(int $a, int $b) {
    return $a + $b;
}

// echo add("20f", 2) . "\n"; // será lançada uma exceção devido a incompatibilidade de tipos

// Tipagem Fraca
var_dump(add(1.5, 2.7)) . "\n"; // int(3) => tipo sofreu coerção de tipo para retornar valor do tipo integer
var_dump(add(1, 2)) . "\n";     // int(3)