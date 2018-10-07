<?php

// While
// Laços `while` têm mesma sintaxe e semântica que em C

// Exemplo 1
$i = 0;

while ($i < 10) {
    echo $i++ . "\n";
}

// Exemplo 2
$i = 0;

while ($i < 10):
    echo $i . "\n";
    $i++;
endwhile;

// Do...while
// Mesma sintaxe que em C.

$i = 0;

do {
    echo $i++ . "\n";
} while ($i < 10);

// Parar a execução no meio de um bloco com `break`.
$i = 0;
do {
    echo $i++ . "\n";

    if ($i > 10) break;

} while (true);
