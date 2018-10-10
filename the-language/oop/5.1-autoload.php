<?php

// AUTOLOADING CLASSES
// É muito comum dividir as classes criadas para cada arquivo.
// No entanto, para incluir as classes, é preciso fazer `includes` massivamente.

// Exemplo 1: Carregar as classes MyClass1 e MyClass2 dos arquivos MyClass1.php e MyClass2.php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php'; // arquivos serão carregados
});

$obj1 = new MyClass1();
$obj2 = new MyClass2();