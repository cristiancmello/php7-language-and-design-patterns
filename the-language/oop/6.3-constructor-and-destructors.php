<?php

// DESTRUCTORS
// O método destrutor será chamado assim que todas as referências a um objeto
// particular forem removidas ou quando o objeto for explicitamente 
// destruído ou qualquer ordem na sequência de encerramento.

// Exemplo 4: Exemplo de destrutor
class MyDestructableClass
{
    function __construct()
    {
        print("In constructor.\n");
        $this->name = "MyDestructableClass";
    }

    function __destruct()
    {
        print("Destroying " . $this->name . "\n");
    }
}

$obj = new MyDestructableClass();

/*
In constructor.
Destroying MyDestructableClass
*/

// Exemplo 5: Chamando destructor da classe pai
class MySubDestructableClass extends MyDestructableClass
{
    function __destruct()
    {
        parent::__destruct();
    }
}

// NOTA: mesmo que use `exit()`, os destructors são chamados.
// Mas, caso `exit()` seja chamado num destructor, os demais não serão executados.