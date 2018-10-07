<?php

// Control Structures
// Intrução pode ser: atribuição, chamada de funções, um loop, uma instrução condicional,
// e até mesmo uma instrução que não faz nada (comando vazio).

// Intruções geralmente terminam em `;`

// Encapsulamento de um grupo de instruções com `{}`
// INTRUÇÃO pode ser um BLOCO DE COMANDOS
{
    null; // nenhuma operação
    ; // nenhuma operação
}

// If
/*
conditional_if ::= if (<expr>) <statement>

expr ::= expressão booleana
*/

$a = 1;
$b = 2;

if ($a < $b)
    echo "a é menor do que b" . "\n";

// Statement pode ser um BLOCO DE COMANDOS
if ($a < $b) {
    echo "a é menor do que b" . "\n";
    $a = $b;
}

// Statement pode conter BLOCOS DE COMANDOS COM IFs ANINHADOS
// INDEFINIDAMENTE.
if (true) {
    if ($a == $b) echo "a é igual a b" . "\n";
}

// Else
// Usado para expressar a condição adversa ao if
$a = 10;

if ($a == $b) {
    echo "a é igual a b" . "\n";
} else {
    echo "a é diferente de b" . "\n";
}

// Elseif (ou else if)
// Podemos designar mais condições adversas ao primeiro if
if ($a == $b) {
    echo "a é igual a b" . "\n";
} elseif ($a > $b) {
    echo "a é maior do que b" . "\n";
} else {
    echo "a é menor do que b" . "\n";
}

// IMPORTANTE: o uso de `:` para definir condições de if / elseif
// NÃO ADMITE SEPARAÇÃO DO TERMO `elseif`
// Sintaxe errada
/*
if ($a > $b):
    echo "a é maior do que b" . "\n";
else if ($a == $b): // irá gerar falha de interpretação
    echo "a é igual a b" . "\n";
endif;
*/

// Sintaxe correta
if ($a > $b):
    echo "a é maior do que b" . "\n";
elseif ($a == $b):
    echo "a é igual a b" . "\n";
endif;

// Sintaxe alternativa para estruturas de controle
// if, while, for, foreach e switch suportam uso de `:`

?>

<?php if (true): ?>
Sempre true. <!-- output HTML -->
<?php endif; ?>

<!-- MISTURA DE SINTAXES COM `:` e `{}` NÃO É SUPORTADA NO MESMO BLOCO DE CONTROLE -->

<!-- IMPORTANTE: QUALQUER SAÍDA (INCLUSIVE ESPAÇOS EM BRANCO) ENTRE `switch`
E O PRIMEIRO CASE IRÁ RESULTAR NUM ERRO DE SINTAXE. -->
<?php $foo = 1 ?>
<?php switch($foo): ?>
<?php case 1: ?> <!-- espaços à esquerda não são permitidos -->
<?php endswitch ?>
