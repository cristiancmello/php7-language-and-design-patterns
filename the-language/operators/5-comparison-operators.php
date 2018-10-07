<?php

// Comparison Operators

// 1. Igual
$a = 1;
$b = 1;
$a == $b;

// 2. Idêntico
$a === $b; // pode ser quebrado em $a == $b && gettype($a) == gettype($b)

// 3. Diferente
// Forma 1
$a != $b;

// Forma 2
$a <> $b;

// 4. Não idêntico (diferente em valor OU em tipo)
$a !== $b; // $a != b || gettype($a) != gettype($b)

// 5. Menor que
$a < $b;

// 6. Maior que
$a > $b;

// 7. Menor ou igual
$a <= $b;

// 8. Maior ou igual
$a >= $b;

// 9. Spaceship (nave espacial)
$r = 1 <=> 1; // equivale a uma comparação (semelhante em C com a função `strcmp`)
echo $r . "\n"; // 0 -> iguais

$r = 2 <=> 1;
echo $r . "\n"; // 1 -> número maior está no operando da esquerda e menor na direita

$r = 1 <=> 2;
echo $r . "\n"; // -1 -> número maior está no operando da direita e menor na esquerda

// Comparações com String numérica

// Igual
$a = "10";
$b = "10";

echo ($a == $b) . "\n"; // 1

// Idêntico
echo ($a === $b) . "\n"; // 1

// Entretanto, se mudarmos o tipo de $b
$b = 10;
echo ($a === $b) == true? 'iguais' : 'diferentes'. "\n"; // diferentes, pois são de tipos diferentes

// Nota: notação científica também pode ser representada numa string e operada como integer
$a = "12e3";
$b = "4";

echo ($a + $b) . "\n"; // 12004

// Spaceship também pode ser usado para comparação alfabética de strings
$a = "b";
$b = "a";
$r = $a <=> $b;

echo $r . "\n"; // 1 -> quer dizer que 'b' vem depois de 'a'

$a = "apple";
$b = "apple";

echo ($a <=> $b) . "\n"; // 0 -> as duas palavras são iguais alfabeticamente
