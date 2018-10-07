<?php

// Operators Precedence
// Tabela de precedência: https://secure.php.net/manual/pt_BR/language.operators.precedence.php#language.operators.precedence

// A precedência de operador especifica quem tem mais prioridade
// quando há mais de 2 operações numa mesma expressão.

// A multiplicação é um caso clássico de maior precedência que a soma
$r = 1 + 5 * 3; // 5*3 = 15 + 1 = 16
echo $r . "\n";

// Podemos forçar a precedência com uso de parênteses
$r = (1 + 5) * 3; // 6 * 3 = 18
echo $r . "\n";

// Associatividade
// Quando operadores tem a mesma precedência, a associatividade decide
// como os operadores são agrupados.
// A soma e subtração são casos de associatividade à esquerda
$r = 1 - 2 - 3; // (1 - 2) - 3 = -4
echo $r . "\n";

// Atribuição tem associativdade à direita
$r = $a = $b = 2;

// Ordem de associativdade seria
// 1. $r = $a = ($b = 2)
// 2. $r = ($a = 2)
// 3. $r = 2
echo $r . "\n";

// Operadores com a mesma precedência SEM ASSOCIATIVIDADE NÃO PODEM
// SER UTILIZADOS UNS PRÓXIMOS AOS OUTROS.
// $r = 1 > 2 < 3; // Ilegal e dará erro de parse

// Existe o caso de operadores SEM ASSOCIATIVIDADE MAS COM PRECEDÊNCIA DIFERENTE
$r = 1 <= 1 == 1; // 1 <= (1 == 1) ::= 1 <= 1 ::= 1 (true)
echo $r . "\n";

// PHP EM GERAL NÃO ÉSPECIFICA A ORDEM DAS AVALIAÇÕES. CÓDIGOS QUE ASSUMEM
// ORDENS ESPECÍFICAS DE AVALIAÇÃO DEVEM SER EVITADOS PORQUE O COMPORTAMENTO
// PODE SER ALTERADO ENTRE VERSÕES DO PHP OU DEPENDENDO DO CÓDIGO EM VOLTA.

// Exemplo de ordem de avaliação não definida
$a = 1;
echo $a + $a++ . "\n"; // pode ser 2 ou 3 dependendo do contexto

// IMPORTANTE: PHP NÃO POSSUI RIGIDEZ DE LINGUAGENS COMO C PARA DEFINIR
// FORMALMENTE A ORDEM DE AVALIÇÃO. A expressão acima é um caso interessante
// Em C ocorreria que $a sendo 1 seria somada a ela mesma e após a instrução
// `echo $a + $a++ . "\n";` é que a variável $a teria valor 2. Em PHP isso não ocorre.

// NOTA: Embora o operador `=` tenha uma precedência menor que a maioria dos
// operadores, o PHP ainda permite expressões similares como abaixo
function foo() {
    return true;
}

if (!$a = foo()); // $a recebe o valor de foo() primeiramente e depois aplica a negação

echo $a . "\n"; // 1 (ou true)
