<?php

// Break
// Tem comportamento semelhante em C.
// Aplica-se em: for, foreach, while, do...while e switch

// IMPORTANTE: `break` aceita um argumento numérico opcional que diz
// quantas estruturas aninhadas deverá interromper. O valor padrão é 1,
// ou seja, somente a estrutura imediata é interrompida.
$i = 0;

while (++$i) {
    switch ($i) {
        case 5:
            echo "At 5\n";
            break 1; /* saindo somente do switch */
        case 10:
            echo "At 10\n";
            break 2;
        default:
            break;
    }
}
