<?php

// Declare
// É uma instrução usada para definir diretivas de execução para um bloco
// de código.

/*
inst_declare ::= declare (<diretive>) <statement>
diretive ::= [ticks | encoding | strict]
*/

// IMPORTANTE: diretivas não pode ser variáveis nem constantes, pois
// são manipuladas em tempo de interpretação.

// Válido
declare(ticks=1);

// Inválido
// declare(ticks=TICK_VALUE); -> TICK_VALUE é constante e isso é inválido

// Declaração com escopo global
declare(ticks=1);

// Declaração com escopo definido limitadamente
declare(ticks=1) {
    // Somente aqui dentro que será aplicado.
}

// Ticks
// É um evento que ocorre a cada N declarações de baixo nível executadas
// pelo interpretador dentro do bloco `declare`. O valor de N é especificado
// usando `ticks=N` dentro do bloco `declare` da seção `diretive`.
declare(ticks=1);

// Função que será chamada a cada evento tick
function tick_handler() {
    echo "tick_handler() called\n";
}

register_tick_function('tick_handler');

$a = 1;

if ($a > 0) {
    $a += 2;
    print($a."\n");
}
