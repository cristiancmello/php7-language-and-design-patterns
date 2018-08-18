<?php

// Variables variables
// É conveniente possuir variáveis com nomes variáveis

$a = 'hello'; // variável chamada `a` com valor `hello`

// Uma variável variável obtém o valor de uma variável e a trata como o
// nome de uma variável.
$$a = 'world';

echo "$a ${$a}"."\n"; // hello world

// Na árvore de símbolos do PHP, irá ocorrer:
// (*) variável 'a' contém o valor 'hello'
// (*) conteúdo de 'a' nomeará uma variável, chamada 'hello', contendo o valor 'world'


// Propriedade variável
class Foo {
    var $bar = 'I am bar.';
    var $arr = [ 'I am A', 'I am B', 'I am C' ];
    var $r = 'I am r.';
}

$foo = new Foo();
$bar = 'bar';
$baz = [ 'foo', 'bar', 'baz', 'quux' ];

echo $foo->$bar . "\n"; // I am bar.
echo $foo->{$baz[1]} . "\n"; // I am bar. (obs.: nome da propriedade definido em {$baz[1]}, com $baz[1] = 'bar')

$start = 'b';
$end = 'ar';
echo $foo->{$start . $end} . "\n"; // I am bar.

$arr = 'arr';
echo $foo->{$arr[1]} . "\n"; // I am r.

// Caso interessante para utilizar: outputs de funções como `json_decode`
$person = json_decode('{"name": "John Doe"}'); // por padrão retorna object stdClass
$name_prop = 'name';

echo $person->{$name_prop} . "\n"; // John Doe

// AVISO
// (*) VARIÁVEIS VARIÁVEIS NÃO PODEM SER UTILIZADAS EM ARRAYS SUPERGLOBAIS
//     DENTRO DE FUNÇÕES OU MÉTODOS DE CLASSE;
// (*) A VARIÁVEL `$this` TAMBÉM NÃO PODE SER REFERENCIADA DINAMICAMENTE.
