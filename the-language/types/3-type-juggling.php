<?php

// Type Juggling
// PHP NÃO REQUER NEM SUPORTA DEFINIÇÃO DE TIPOS EXPLÍCITA NA DECLARAÇÃO
// DE VARIÁVEIS: O TIPO É DEFINIDO PELO CONTEXTO EM QUE A VARIÁVEL É UTILIZADA

// Exemplos de conversão automática
$foo = "0";
$foo += 2;

echo $foo."\n"; // 2

$foo = 5 + "10 pequenos porcos";
echo $foo."\n"; // 15

// NOTA: O COMPORTAMENTO DE UMA CONVERSÃO AUTOMÁTICA PARA ARRAY É INDEFINIDA
// IMPORTANTE: PHP SUPORTA INDEXAÇÃO EM STRINGS VIA ÍNDICE
$a = 'car';
$a[0] = 'b';
echo $a."\n"; // bar
