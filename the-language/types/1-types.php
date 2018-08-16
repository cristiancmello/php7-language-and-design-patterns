<?php

// PHP suporta 10 tipos primitivos
// 4 escalares: {boolean, integer, float (ou double por razões históricas), string}
// 4 compostos: {array, object, callable, iterable} -> isto é, formado por porções escalares
// 2 tipos especiais: {resource, NULL}

// Pseudo-tipos por razões de leitura: {mixed, number, callback (aka callable), array|object, void}
// Pseudo-variável: {$...}

// IMPORTANTE: em PHP, não é possível declarar o tipo de variável. O interpretador
// define em runtime

// Checar tipo e valor de uma expressão
$a_bool = TRUE; // boolean

var_dump($a_bool); // imprime `bool(true)`

// Legível para humanos
echo gettype($a_bool);  // imprime `boolean`

$a_str = "foo"; // string
echo "\n"; // new line
echo gettype($a_str); // `string`

// `is_int()` : verificar se variável é um integer
$a_int = 12;
echo "\n";
echo is_int($a_int); // `1`

// `is_string()`: verifica se é uma string
echo "\n";
echo is_string($a_str); // `1`

// Configurar tipo de variável (modo forçado)
echo "\n";
settype($a_str, "integer");
echo gettype($a_str)."\n"; // `integer`

// Booleans
// Expressa um valor de verdade. Pode ser TRUE ou FALSE (são case-insensitive)
$a_bool = true; $a_bool = True; $a_bool = tRuE;

// Casting para Boolean
echo gettype((bool) "")."\n"; // `boolean`
echo gettype((boolean) 3.14)."\n"; // `boolean`

/* É considerado como FALSE:
 * FALSE booleano
 * integer 0
 * float 0.0
 * string "" e "0"
 * array [] ou array() -> com zero elementos
 * NULL (incluindo variável não definida)
 * objetos SimpleXML de tags vazias
 */
$equivalents = false == !(0 == (0.0 == !("" == ("0" == !([] == NULL)))));
var_dump($equivalents); // `bool(true)`

/* Todo o resto é considerado TRUE (inclusive resource e NAN) */

// Integers
// É um número na reta dos inteiros ℤ = {..., -2, -1, 0, 1, 2, ...}

// Podemos representar como:
$a_int = 1234; // decimal
$a_int = -123; // decimal negativo
$a_int = 0xFFF; // hexadecimal
$a_int = 0b101011; // binário

// Comprimento do inteiro dependerá da arquitetura do SO/CPU
// Atualmente, a grande maioria dos sistemas são de 64-bit
$large_number = 2147483648;
var_dump($large_number); // `int(2147483648)` -> com estouro em 32-bit continua sendo inteiro

$large_number = 9223372036854775808;
var_dump($large_number); // `double(9.2233720368548E+18)` -> estouro em integer forçou casting para float/double

// NÃO EXISTE DIVISÃO INTEIRA EM PHP
// Qualquer operação de divisão resulta num valor float/double
var_dump(1/2); // `double(0.5)`
var_dump((int) (1/2)); // `int(0)`
var_dump(round(1/2)); // `double(1)` -> round() é função de teto

// Real numbers
// Seguem a sintaxe
$a = 1.14;
$b = 1.2e3; // 1.2 * 10^3
$c = 7E-10; // 7 * 10^(-10)

/* IMPORTANTE: PHP usa precisão do IEEE 754. No entanto, há falta de
   confiabilidade nos resultados e comparações devido a perda de precisão.

   Há 2 soluções para resolver esses problemas:
    * GMP functions: https://secure.php.net/manual/en/ref.gmp.php
    * BC Math Functions: https://secure.php.net/manual/en/ref.bc.php
*/

// NaN (Not a Number)
// Algumas operações podem resultar em NAN
echo is_nan(NAN); // `1`

// Strings
// É uma sequência de caracteres.
// A codificação dependerá da codificação do arquivo do script e se Zend Multibyte
// estiver habilitado.
// A grande maioria dos sistemas codifica os scripts PHP como Unicode
// Em PHP 7 em sistemas de 64-bit, não existe limite em RAM para a string

// Single quoted
echo "\n";
echo 'this is a simple string';
echo "\n";
echo 'Line 1
Line 2';
echo "\n";

// Single quoted não suporta expansão de caracteres de escape nem de variáveis
echo '\n'; // `\n`
echo "\n"; // Double quotes suporta caractere de escape
echo 'You deleted C:\\*.*'; // `You deleted C:\*.*` -> neste caso imprime '\'

// Double quoted
// caracteres especiais são interpretados
echo "\n"; // Line Feed
echo "\r"; // Carriage Return
echo "\$"; // Dollar sign
echo "\""; // Double-quote
echo "\xFA\n"; // Representação hexadecimal
echo "\u{FF}"; // Imprime Unicode

// Variáveis podem ser expressas
$a_str = "Hello";
echo "\n$a_str\n";

// Heredoc
$name = "Cristian";

$str = <<<EOT
Example of string
snapping multiple lines
using heredoc syntax.

I'am $name
EOT;

echo $str.PHP_EOL; // PHP End Of Line

// Desde PHP 7.1, "" <=> []
$str = "foo";
echo $str[1]."\n";

// Nota: Acessar ou modificar uma string usando brackets não são multi-byte safe.
// Isso só deve ser feito com string single-byte com a ISO 8859-1

// Operações com String: concatenação `. e atribuição curta de concatenação `.=`
$a = 'hello'.'world';
$a .= '!';
echo "$a\n"; // `helloworld!`

/*
 FUNÇÕES ÚTEIS : https://secure.php.net/manual/en/ref.strings.php
 URL Functions: https://secure.php.net/manual/en/ref.url.php
 Encrypt/Decrypt String: https://secure.php.net/manual/en/ref.sodium.php e
    https://secure.php.net/manual/en/ref.hash.php
 */
