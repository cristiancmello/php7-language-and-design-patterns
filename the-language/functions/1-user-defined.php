<?php

// Functions

// Funções definidas condicionalmente
$makefoo = true;

bar();

if ($makefoo) {
    function foo() {
        echo 'foo() called'."\n";
    }
}


if ($makefoo) foo();

function bar() {
    echo 'bar(): eu não existo até que o programa passe por aqui'."\n";
}

// Funções aninhadas
function foo2() {
    function bar2() {
        echo "bar in foo"."\n";
    }
}

// ATENÇÃO! Não podemos chamar `bar2()` ainda porque ela não foi definida ainda
foo2(); // após a chamada de `foo2()`, `bar2()` estará disponível para ser chamada
bar2();

// IMPORTANTE!!!!
// Em PHP, NÃO EXISTE SOBRECARGA DE FUNÇÕES. Também não é possível alterar cancelar
// ou alterar definição de funções da mesma forma que elas aparecem nas declarações.

// NOTA: NOMES DE FUNÇÕES SÃO CASE INSENSITIVE. Mas recomenda-se manter o padrão
// de nome declarado

// Funcões Recursivas
// NOTA: chamadas recursivas podem facilmente estourar a pilha de memória.
// Então, deve-se tormar muito cuidado, pois recursão infinita é tida como
// erro de programação.
// Erro comum: `PHP Fatal error:  Uncaught Error: Maximum function nesting level of '256' reached, aborting!`
function recursion($a) {
    if ($a < 10) {
        echo "$a\n";
        recursion($a + 1);
    }
}

recursion(1);

// Número variável de argumentos
// Indicado por `...`
function sum(...$numbers) {
    $acc = 0; // acumulador
    
    foreach ($numbers as $n) {
        $acc += $n;
    }

    return $acc;
}

print(sum(1, 2, 3, 4, 5)."\n"); // 15

// É possível usar `func_get_args` para forma equivalente acima
function newSum() {
    $acc = 0;
    foreach (func_get_args() as $n) {
        $acc += $n;
    }

    return $acc;
}

print(newSum(1, 2, 3, 4, 5)."\n"); // 15

// Usando `...` para fornecer argumentos
function add($a, $b) {
    return $a + $b;
}

echo add(...[1, 2]) . "\n"; // 3

// Valores padrão de argumentos
function makecoffee($type = 'capuccino') {
    return "Fazendo uma xícara de café $type."."\n";
}

echo makecoffee(null) . "\n"; // Fazendo uma xícara de café .
echo makecoffee('espresso ristretto') . "\n"; // Fazendo uma xícara de café espresso ristretto.
echo makecoffee() . "\n"; // Fazendo uma xícara de café capuccino.

// Usando tipos padrão de argumentos não escalares
function newMakeCoffee($types = array('capuccino'), $coffeeMaker = null) {
    $device = is_null($coffeeMaker)? 'hands' : $coffeeMaker;
    
    return "Making cup of ".join(", ", $types)." with $device.";
}

echo newMakeCoffee() . "\n"; // Making cup of capuccino with hands.
echo newMakeCoffee(['espresso', 'capuccino']) . "\n"; // Making cup of espresso, capuccino with hands.