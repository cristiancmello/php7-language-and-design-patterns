<?php

// Callbacks / Callables
// Callbacks -> representadas pelas declarações de tipo callable

// Funções como `call_user_func()` ou `usort()` aceitam funções
// de callback definidas pelo usuário como parâmetro. Funções de callback
// não precisam ser apenas funções simples, mas também métodos de objetos
// incluindo os estáticos.

// Nomes de função aceitos: todos menos construtores de linguagem como `array`, `echo`, ...

// Exemplo de função de callback
function fn_callback() {
    print("Hello, World!\n");
}

// TIPO I: callback simples
call_user_func('fn_callback'); // Hello, World!

// Outro exemplo de método de callback
class MyClass {
    static function method_callback() {
        print("Hello, World!\n");
    }
}

// TIPO II: chamada à método estático
call_user_func(['MyClass', 'method_callback']); // Hello, World!
// ou
call_user_func('MyClass::method_callback'); // Hello, World!


// TIPO III: chamada à metodos de objetos
$obj = new MyClass();
call_user_func([ $obj, 'method_callback' ]); // Hello, World!


// TIPO IV: chamada relativa à metodos estáticos por herança
class A {
    public static function who() {
        print("A\n");
    }
}

class B extends A {
    public static function who() {
        print("B\n");
    }
}

call_user_func(['B', 'parent::who']); // A

// TIPO V: objetos que implementam __invoke podem ser utilizados como callables
class C {
    public function __invoke($name) {
        echo "Hello ", $name, "\n";
    }
}

$c = new C();
call_user_func($c, 'PHP 7!'); // Hello PHP 7!

// Callback utilizando Closure
$double = function($x) {
    return $x * 2;
};

$numbers = range(1, 5); // produz lista [1, 2, 3, 4, 5]

$new_numbers = array_map($double, $numbers);

print implode(' ', $new_numbers)."\n"; // 2 4 6 8 10

// NOTA: CALLBACKS REGISTRADOS COM FUNÇÕES `call_user_func()` e
// `call_user_func_array()` NÃO SERÃO CHAMADOS CASO HAJA UMA EXCEÇÃO
// NÃO CAPTURADA LANÇADA NUM CALLBACK ANTERIOR.
