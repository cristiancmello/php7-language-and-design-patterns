<?php

// Anomymous Functions (or Closures)
// São funções sem nomeação. Podem ser passadas como parâmetro de classe Closure

// Passando uma função anônima como parâmetro
print_r(
    array_map(function ($n) {
        return $n ** 2;
    }, [1, 2, 3])
);

/*
    Array
    (
        [0] => 1
        [1] => 4
        [2] => 9
    )
*/

// Definindo uma função anônima para uma variável
$square = function ($n) {
    return $n ** 2;
};

echo $square(12) . "\n"; // 144

// Herdando variáveis de escopo anterior
$message = 'hello';

$example = function () {
    var_dump($message);
};

// $example(); => a chamada irá procovar uma exceção

// Uso da palavra `use`
$example = function () use ($message) {
    var_dump($message);
};

$example(); // string(5) "hello"

// O caso abaixo demonstra que apesar da modificação feita na variável $message,
// o contéudo dela não foi atualizado pela função anônima
$message = 'world';
$example(); // string(5) "hello"

// Resetar mensagem
$message = 'hello';

$example = function () use (&$message) {
    var_dump($message);
};

// O caso abaixo demonstra que a modificação da variável $message foi efetivado
// com uso de herânça por referência
$message = 'world';
$example(); // string(5) "world"

// Vinculação automática do `$this`
class Test
{
    public function testing()
    {
        return function() {
            var_dump($this);
        };
    }
}

$obj = new Test;
$function = $obj->testing();
$function();

/*
class Test#3 (0) {}
*/

// Funções anônimas estáticas
// É uma forma de prevenir que a classe corrente seja vinculada a função anônima

class Foo
{
    function __construct()
    {
        $func = static function() {
            var_dump($this);
        };

        $func();
    }
}

// new Foo;

// Tentando vincular um objeto a uma função anônima estática
$func = function () {
    echo 'func()' . "\n";
};

$func = $func->bindTo(new stdClass); // Closure::bindTo => duplica a closure com um objeto vinculado a um escopo de classe
$func();