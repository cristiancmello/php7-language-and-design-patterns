<?php

// Increment/Decrement Operators
// PHP suporta operadores de pré e pós incremento/decremento C-style.

// IMPORTANTE
// número e strings => FUNCIONAM;
// array, objects e resources => NÃO SÃO AFETADOS;
// NULL => decrementar não gera efeitos
// NULL => incrementar resulta em 1 (associação implícita que NULL = '\0' ou zero)
// boolean => não há efeito

// Pré-incremento/decremento
$a = 0;
echo ++$a . "\n"; // 1
echo $a . "\n"; // 1

// Pós-incremento/decremento
echo $a++ . "\n"; // 1
echo $a . "\n";   // 2

// OPERAÇÕES ARITMÉTICAS EM VARIÁVEIS CARACTERE
// PHP não trata da mesma forma que ocorre em C (incremento numérico na posição
// do caractere na tabela ASCII).
$a = 'Z'; // Z equivale ao número 90 em ASCII;
$a++;
echo $a . "\n"; // no entanto, PHP imprime como 'AA' ou invés de '[' (código 91)

// IMPORTANTE: incrementar ou decrementar outros caracteres fora da tabela ASCII
// NÃO TEM EFEITOS, ASSIM A STRING ORIGINAL NÃO É MODIFICADA.

// Exemplos interessantes
// Imprimir sequência de além de 'Z'
for ($i = 0, $chr = 'Z'; $i < 10; $i++, $chr++) {
    echo $chr . "\n";
}

// Sequência: AA, AB, AC, AD, AE, AF, AG, AH, AI (semelhante a sequência combinatória)

// Imprimir sequência com dígitos
for ($i = 0, $chr = 'A0'; $i < 10; $i++, $chr++) {
    echo $chr . "\n";
}

// Sequência: A0, A1, A2, A3, A4, A5, A6, A7, A8, A9
