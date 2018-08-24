<?php

// Continue
// Usado para pular o resto da iteração atual e continuar a execução
// na validação da condição e, então, iniciar a próxima iteração

for ($i = 0; $i < 5; $i++) {
    if ($i == 2):
        continue;
    endif;

    echo $i . "\n";
}

/*
0
1
3
4
*/

// Continue, assim como break, suporta indicar estrutura de controle aninhada
// Obs.: switch é encarado em PHP como um tipo de laço
for ($i = 0; $i < 5; $i++) {
    switch ($i) {
        case 2:
            continue 2;
    }

    echo $i . "\n";
}

/*
0
1
3
4
*/
