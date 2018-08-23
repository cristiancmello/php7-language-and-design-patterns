<?php

// Array Operators
// Os operadores aritméticos se comportam de forma semelhante a Teoria dos Conjuntos.

// União
$a = ['a' => 'maçã', 'b' => 'banana'];
$b = ['a' => 'pera', 'b' => 'framboesa', 'c' => 'morango'];

$uniao = $a + $b; // A união B

print_r($uniao);

/*
Array(
    [a] => maçã
    [b] => banana
    [c] => morango
)
*/

// Igualdade
$a = [1, 2, 3];
$b = [1, 2, 3];

$igualdade = ($a == $b);
echo $igualdade . "\n"; // 1

$b = [1, 2, -3];

$igualdade = ($a == $b);
echo ($igualdade == false) . "\n"; // 1

// Desigualdade
echo (($a != $b) == true) . "\n";
echo (($a <> $b) == true) . "\n"; // forma equivalente

// Identidade
// Verifica se $a e $b tem os mesmos pares de chave/valor na mesma ordem e do mesmo tipo

$a = ['1', 2, 3];
$b = [1, 2, 3];

echo (($a === $b) == false) . "\n"; // 1

// Não identidade
echo (($a !== $b) == true) . "\n";

// União em atribuição curta
$a = [1, 2, 3];
$b = [2, 3, 4];

$a += $b; // é o meso que $a = $a + $b
print_r($a);

$a = ['a' => 'banana', 'b' => 'maçã'];
$b = ['a' => 'banana', 'b' => 'pera', 'c' => 'laranja'];

// Se array $a e $b tiverem as mesmas chaves, os valores para essas chaves em
// de $b são ignorados e de $a são mantidos
$a += $b;

print_r($a);

/*
Array
(
    [a] => banana
    [b] => maçã
    [c] => laranja
)
*/

// Array Functions: https://secure.php.net/manual/en/ref.array.php
