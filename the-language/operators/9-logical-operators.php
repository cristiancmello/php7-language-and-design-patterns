<?php

// LOGICAL OPERATORS

// OPERADORES COM PRECEDÊNCIA MAIOR
$a = true;
$b = false;

// AND
echo (($a && $b) == false). "\n"; // 1 (isto é, false)

// OR
echo (($a || $b) == true). "\n"; // 1

// NOT
echo ((!$a) == false) . "\n"; // false

// OPERADORES COM MENOR PRECEDÊNCIA
// AND
echo (($a and $b) == false). "\n"; // 1

// OR
echo (($a or $b) == true). "\n"; // 1

// XOR
echo (($a xor $b) == true). "\n"; // 1

// CURTO CIRCUITO
// Há casos onde funções não são chamadas em expressões lógicas
$a = (false && foo()); // foo() nunca será chamada devido a expressão]
$a = (true || foo()); // foo() também não será chamada

// Um atribuição sintética
$e = false || true; // equivale ($e = (false || true))
echo $e . "\n"; // 1

$f = false or true; // equivale (($f = false) or true)
var_dump($e, $f); // $e = bool(true); $f = bool(false)

// `&&` tem maior precedência que `and`
$g = true && false; // equivale ($g = (true && false))

$h = true and false; // equivale (($h = true) and false)

var_dump($g, $h); // $g => bool(false); $h = bool(true)
