<?php

// For
// Possui comportamento semelhante em C.

/*
loop_for ::= for (expr1; expr2; expr3) statement
*/

// IMPORTANTE: se expr2 tiver uma lista de expressões separadas por ','
// o PHP irá avaliar todas as expressões, mas o resultado da última é considerada.

// Loop infinito mas com `break`
for ($i = 0; ; $i++) {
    if ($i == 2) {
        break;
    }

    echo $i . "\n";
}

// For resumitivo
for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i . "\n", $i++);

// For com `:` é suportado
for (; ;):
    echo "Primeira iteração" . "\n";
    break;
endfor;
