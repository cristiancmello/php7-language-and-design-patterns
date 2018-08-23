<?php

// Type Operators

// `instanceof`: usado para determinar se uma variável em PHP é um objeto
// instanciado de uma certa classe.

// Exemplo 1: usando `instanceof` com classes
class A {}

class B {}

$a = new A();

var_dump($a instanceof A); // bool(true)
var_dump($a instanceof B); // bool(false)

// `instanceof` pode ser usado para atestar se uma variável é um objeto
// instanciado de uma classe que herda de uma classe pai
class ParentClass {}

class MyClass extends ParentClass {}

$a = new MyClass;

var_dump($a instanceof MyClass);      // bool(true)
var_dump($a instanceof ParentClass);  // bool(false)

// Verificar se um objeto não é uma instância de uma determinada classe
var_dump(!($a instanceof stdClass));  // bool(true)

// `instanceof` pode ser usado também para determinar se uma variável é um
// objeto instanciado de uma classe que implementa uma interface.

interface MyInterface {}

class MyClassA implements MyInterface {}

$a = new MyClassA;

var_dump($a instanceof MyInterface); // bool(true)

// IMPORTANTE: o operando direito pode ser diferente do tipo object.
// NÃO É PERMITIDO CONSTANTES.
$c = 'MyClassA';
var_dump($a instanceof $c); // $a instanceof 'MyClassA' => NÃO É SUPORTADO

// ATENÇÃO: O OPERANDO DIREITO DEVE SER UMA VARIÁVEL E NÃO LITERAL
