<?php

// Arithmetic Operators
// Identidade
$a = 1;
$b = 1;
$r = +$a; // `+$a` -> conversão de $a para int ou float

// Negação
$r = -$a; // Oposto de $a

// Adição
$r = $a + $b;

// Subtração
$r = $a - $b;

// Multiplicação
$r = $a * $b;

// Divisão
$r = $a / $b; // Quociente entre $a e $b. $r é float

// CASOS DE DIVISÃO COM RESULTADO INTEIRO:
// (1) Operandos sendo inteiros;
// (2) Strings que são convertidos para inteiros;
// (3) Números inteiramente divisíveis.

echo gettype(2 / 2) . "\n"; // integer
echo gettype("12" / "6") . "\n"; // integer

// `intdiv()`: função de divisão inteira
$r = intdiv(10, 2.5);
echo $r . "\n"; // 5
echo gettype($r) . "\n"; // integer

// Módulo
$r = $a % $b; // Resto de $a dividido por $b

// Exponenciação
$r = $a ** $b; // Mesmo que $a^$b ($a elevado a $b)
