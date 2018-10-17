<?php

// GENERATORS
// É um mecanismo mais práticos para se implementar Iterators sem recorrer
// a implementação de Interfaces como Iterator, IteratorAggregate, ...

// IMPORTANTE: Utiliza-se muito Generators quando se tem que manipular um grande conjunto de dados
//             de acesso sequencial.
// DICA: Generators são usados para programação assíncrona em PHP. Existe uma framework que auxilia
//       chamado AMP <https://github.com/amphp/amp>

// Exemplo 1: Demonstração do que a palavra `yield` retorna, que é o coração dos generators
function getLines()
{
    yield 'line 1';
    yield 'line 2';
    yield 'line 3';
}

var_dump(getLines()); // um objeto Generator, que é um Iterator, é retornado de `getLines()`

/*
class Generator#1 (0) {}
*/

// Exemplo 2: Iterando sobre Generators
foreach (getLines() as $line) {
    echo "{$line}\n";
}

/*
line 1
line 2
line 3
*/

function getLinesWithFor()
{
    for ($i = 0; $i < 5; $i++) {
        yield "line $i";
    }
}

foreach (getLinesWithFor() as $line) {
    echo "{$line}\n";
}

/*
line 0
line 1
line 2
line 3
line 4
*/

// Exemplo 3: É possível que `yield` retorne `key => value` para array associativo
function getEvenNumbers()
{
    for ($i = 0; $i < 10; $i++) {
        yield $i => $i * 2;
    }
}

foreach (getEvenNumbers() as $key => $value) {
    echo "{$key} => {$value}\n";
}

/*
0 => 0
1 => 2
2 => 4
3 => 6
4 => 8
5 => 10
6 => 12
7 => 14
8 => 16
9 => 18
*/

