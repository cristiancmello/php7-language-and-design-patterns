<?php

declare(strict_types=1);

// Returning Values
function square($num) {
    return $num**2;
}

echo square(10) . "\n";

// Retornando uma referência de função
function &returning_ref() {
    echo 'Returning reference' . "\n";
    return $some_ref;
}

$newRef =& returning_ref();

$newRef; // Returning reference => a função `returning_ref` foi invocada

// Declaração de tipo de retorno
// Em PHP 7, é agora possível declarar um tipo de retorno de função.
// Com strict_types habilitado, a tipagem se torna rígida (forte)
// Por padrão, a tipagem fraca permite coerção de tipos no retorno de funções

function sum($a, $b): float {
    return $a + $b;
}

var_dump(sum(2, 3)) . "\n"; // double(5)


// Especificando tipo de retorno com classe
class C { }

function f(C $c): C {
    return new C;
}

var_dump(f(new C)); // class C#2 (0) { }