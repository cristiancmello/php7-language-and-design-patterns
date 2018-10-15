<?php

// OBJECTS AND REFERENCES
// Um variável objeto armazena uma cópia do identificador de um objeto em memória.
// Uma referência para PHP é um sinônimo, que permite que duas variáveis diferentes escreverem
// para o mesmo valor.

// Exemplo 1: Cópia de identificador com uso de `=`
class A
{
    public $foo = 1;
}

$a = new A();

// Criamos uma variável $b que serão cópia do mesmo identificador referenciado por $a
$b = $a;

$b->foo = 2;
echo $b->foo . "\n";    // 2

// Logo, $a = $b = {identificador em memória}

// Exemplo 2: Referenciamento
$c = new A();
$d =& $c;   // agora, tanto $d quanto $c possuem a mesma referência criada em memória

$d->foo = 2;
echo $c->foo . "\n";    // 2

// Exemplo 3: passagem de objeto como argumento para uma função
function foo($obj) {
    // Ocorrerá o seguinte: $obj terá cópia do identificador referenciado por $e ($obj = $e = {identificador em memória})

    $obj->foo = 2;
}

$e = new A();
foo($e);

echo $e->foo . "\n";    // 2