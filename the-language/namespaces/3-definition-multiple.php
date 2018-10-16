<?php

namespace MyProjectA
{
    const MY_CONST=1;

    class MyClass {}
}

namespace MyProjectB
{
    const MY_CONST=2;

    class MyClass {}
}

namespace Foo
{
    function strlen() {
        echo "my strlen()\n";
    }

    const INI_ALL = 3;
    class Exception {}

    function test()
    {
        // Chamar a função dentro deste namespace com o nome `strlen` desqualificado
        $a = strlen('hi'); // my strlen()
        
        // Uso do nome de função qualificado num Global Space
        $a = \strlen('hi'); // com o nome qualificado, podemos chamar entidades globais do PHP
        echo $a . "\n";     // 2

        // Chamar uma exceção de nome qualificado
        // A classe abaixo é do PHP e não a que foi internamente criada neste namespace "Foo"
        $c = new \Exception('error');   // Sem a '\', Exception referenciada será a que foi definida dentro deste namespace

        // Chamar a função `strlen` deste namespace com nome TOTALMENTE QUALIFICADO
        $a = \Foo\strlen(); // my strlen()
    }
}