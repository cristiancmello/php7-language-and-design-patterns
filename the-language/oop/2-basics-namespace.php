<?php

// Uso de `::class`
// Podemos usar a palavra-chave `::class` para obter resolução de nome de classes.
// Isso é bem útil quando classes estão contidas em namespaces.

// Exemplo 8: Resolução de nome de classe
namespace MyNamespace
{
    class MyClass
    {

    }

    echo MyClass::class . "\n"; // MyNamespace\MyClass (nome qualificado)
}

/* 
    IMPORTANTE
    A string com nome da classe é processada na fase de compilação.
    Antes que a fase de autoloading ocorra, a string com o nome já é criada.

    Como consequência, os nomes de classe SÃO EXPANDIDOS MESMO QUE A CLASSE
    NÃO EXISTA. Neste caso, NENHUM ERRO SERÁ EXIBIDO.
 */