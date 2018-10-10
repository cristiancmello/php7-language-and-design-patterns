<?php

// Exemplo 3: Autoload com manipulação de exceção
spl_autoload_register(function ($name) {
    echo "Want to load $name.\n";
    throw new Exception("Unable to load $name");
});

try {
    $obj = new NonLoadableClass(); // essa classe não existe e será lançada uma exceção
} catch (Exception $ex) {
    echo $ex->getMessage() . "\n";
}

/*
Want to load NonLoadableClass.
Unable to load NonLoadableClass
*/