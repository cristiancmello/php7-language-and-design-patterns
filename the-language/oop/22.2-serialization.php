<?php

// Exemplo 2: Desserialização de um objeto salvo no arquivo 'store'
include('class_a.inc');

$s = file_get_contents('the-language/oop/store');
$a = unserialize($s);

// Para testar, vamos chamar método da classe desserializada
$a->showOne();