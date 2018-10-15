<?php

// OBJECT SERIALIZATION
// A serialização permite armazenamento dos valores das propriedades contidas num objeto.

// Função `serialize()`
// Retorna uma string contendo uma representação byte-stream de qualquer valor que pode ser
// armazenado pelo PHP.

// Exemplo 1: Instancia uma classe e salva o objeto serializado num arquivo
include('class_a.inc');

$a = new A();
$s = serialize($a);

file_put_contents('the-language/oop/store', $s); // salva arquivo com objeto $a serializado