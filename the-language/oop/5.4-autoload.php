<?php

// Exemplo 4: Autoload com tratamento de exceção customatizada não carregável
spl_autoload_register(function ($name) {
    echo "Want to load $name.\n";
    throw new MissingException("Unable to load $name");
});

try {
    $obj = new NonLoadableClass();
} catch (Exception $ex) {
    echo $ex->getMessage() . "\n";
}

/*
Want to load NonLoadableClass.
Want to load MissingException.
PHP Fatal error:  Uncaught Error: Class 'MissingException' not found in ...
 */