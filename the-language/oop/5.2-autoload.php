<?php

// Exemplo 2: Tentar carregar uma Interface usando autoload
spl_autoload_register(function($name) {
    var_dump($name);
});

class Foo implements ITest
{

}

/* 
    PHP Fatal error:  Interface 'ITest' not found 
 */