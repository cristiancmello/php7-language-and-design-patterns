<?php

// Foreach
// Fornece uma maneira fácil de iterar sobre arrays e objetos.

/*
loop_foreach ::= [ foreach (<array_expr> as $value) statement
                 | foreach (<array_expr> as $key => $value) statement ]
*/

// PRIMEIRA FORMA: itera sobre arrays informados em <array_expr>.
//                 A cada iteração, o valor do elemento atual é atribuído a $value
//                 e o ponteiro interno do array avança uma posição.

// SEGUNDA FORMA: semelhante à primeira, exceto por atribuir a chave do elemento
//                atual a variável $key a cada iteração.

// Customização de iteração em objetos: https://secure.php.net/manual/en/language.oop5.iterations.php

// Modificar valor de um array com uso de referência
$arr = [1, 2, 3, 4];

foreach ($arr as &$value) {
    $value = $value * 2;
}

print_r($arr);

/*
Array (
    [0] => 2
    [1] => 4
    [2] => 6
    [3] => 8
)
*/

unset($value); // desvincular referência ao último elemento

foreach ($arr as $key => $value) {
    echo "{$key} => {$value}" . "\n";
}

/*
0 => 2
1 => 4
2 => 6
3 => 8
*/

// Desempacotando arrays aninhados com construtor `list()`
$array = [
    [1, 2],
    [3, 4]
];

foreach ($array as list($a, $b)) {
    echo "A: $a; B: $b\n";
}

/*
A: 1; B: 2
A: 3; B: 4
*/


// Podemos usar menos argumentos
foreach ($array as list($a)) {
    echo "A: $a\n";
}

/*
A: 1
A: 3
*/

// IMPORTANTE: excesso de parâmentros em `list()` irá gerar
// mensagem `Undefined offset`.
