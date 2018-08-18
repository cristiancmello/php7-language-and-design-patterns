<?php

// Expressions
// (*) São as peças de construção mais importantes em PHP;
// (*) Uma expressão é "tudo o que tem um valor";

// Forma básica de expressão
$a = 5;

// '5' é uma expressão com valor de 5
// '$a' é uma expressão com valor 5

// Funções e a relação de expressão
// FUNÇÕES SÃO EXPRESSÕES COM O VALOR IGUAL AO SEU VALOR DE RETORNO
function foo() {
    return 5;
}

// A função `foo()` -> valor de expressão é 5

// Construções criativas com expressões
// PHP, devido sua natureza orientada a expressões, permite
// alguns truques sintáticos válidos.
$b = $a = 7; // forma 1
$b = ($a = 12); // forma 2, equivalente a forma 1

echo $b . "\n"; // 12


// Operações de incremento e decremento, além de pós e pré-incremento
// também são expressões.

// Expressões formada de expressões de comparação são comuns.
