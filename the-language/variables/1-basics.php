<?php

// Variables
// São representadas em PHP por um sinal de dollar seguido pelo nome da variável.

// Os nomes de variáveis seguem as mesmas regras de qualquer label em PHP.
// label ::= [inicia com 1 letra | underscore ] <quantidade qualquer de letras,
// undescore ou número>

// NOTA: $this é uma variável especial que não pode ser atribuída

// Funções relacionadas a variáveis: https://secure.php.net/manual/pt_BR/ref.var.php

$var = 'Bob';
$Var = 'Joe';

echo "$var, $Var\n";

// Por padrão, as variáveis são sempre atribuídas por valor. Isto significa
// que ao atribuir uma expressão a uma variável, o valor da expressão original
// é copiado integralmente para uma variável de destino. Isto significa também
// que, após atribuir o valor de uma variável a outra, a alteração destas variáveis
// não afetará a outra.

// Atribuição por referência
$foo = 'foo';
$bar = &$foo; // $bar agora pode alterar via referência em memória a variável $foo
$bar = 'bar';

echo $foo."\n"; // bar

// IMPORTANTE: somente variáveis nomeadas podem ser atribuídas por referência.
// $a = &(2 * 7) => inválido por ser expressão sem nome

// function test() { return 25; }
// $f = &test(); => inválido

// Valores padrões de variáveis não inicializadas
var_dump($unset_var); // NULL neste contexto

// String
$unset_str .= 'abc';
var_dump($unset_str); // string(3) "abc"

// Integer
$unset_int += 25;
var_dump($unset_int); // int(25)

// Float/double
$unset_float += 1.25;
var_dump($unset_float); // double (1.25)

$unset_obj->foo = 'bar';
var_dump($unset_obj); // class stdClass#1 (1) { public $foo => string(3) "bar" }

// NA MAIORIA DOS CASOS, O INTERPRETADOR LANÇA UM WARNING "UNDEFINED VARIABLE"
// IMPORTANTE: É UMA BOA PRÁTICA INICIALIZAR AS VARIÁVEIS

// SEGURANÇA
// Confiar no valor padrão de uma variável não inicializada é problemático
// no caso de incluir um arquivo em outro que usa uma variável de mesmo nome.

// (*) É UM DOS MAIORES RISCOS DE SEGURANÇA QUANDO `register_globals` está habilitada;
// (*) Erros de nível E_NOTICE são omitidos no caso de variáveis não inicializadas;
// (*) Construtor de linguagem `isset()` pode ser usado para detectar se uma variável não foi inicializada.
echo "A variável \$a foi inicializada? R: ".(isset($a)? 'sim' : 'não')."\n";
