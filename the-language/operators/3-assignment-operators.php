<?php

// Assignment Operators
// `=` tem o significado de "valor da esquerda recebe o valor da expressão direita".

// O valor de uma expressão de atribuição é o valor atribuído.
$a = ($b = 4) + 5;

// Expressão `$b = 4` tem valor `4`. Assim, podemos afirmar:
$a = 4 + 5;

// A expressão `$a = 4 + 5` vale `9`

// Operadores de atribuição combinados ou atribuição curta
$a = 3;
$a += 10; // mesmo que `$a = $a + 10` <=> `$a = 3 + 10` <=> `$a = 13`

// IMPORTANTE:
// (1) Atribuição copia o valor da variável original para uma nova. Logo,
// a variável original não é afetada.

// (2) Exceção ao comportamento geral de atribuição ocorre com objetos,
// que são atribuídos por referência. Objetos podem ser explicitamente
// copiados através da instrução `clone()`.

// Atribuição por referência
// A partir do PHP 5, o operador `new` retorna uma referência automaticamente,
// de forma que a atribuição de um resultado de `new` por referência gera
// um alerta E_DEPRECATED ou E_STRICT

class C {}

// $obj = &new C; => em PHP 7 é considerado Erro de Parse
