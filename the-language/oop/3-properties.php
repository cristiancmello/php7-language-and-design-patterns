<?php

// Propriedades
// Também podem ser chamadas de "campos" ou "atributos".
// São definidas através das palavras `public`, `protected`, `private` (definição de Visibilidade).
// OPERADOR DE OBJETO ::= -> (serve para métodos de classes acessarem propriedades não estáticas)

// Exemplo 1: Declaração de propriedades
class SimpleClass
{
    public $var1 = 'hello' . 'world'; // atribuição na declaração ocorre em tempo de compilação

    // Podemos também usar heredoc
    public $var2 = <<<EOD
hello world
EOD;

    public $var3 = 1+2;

    // public $var4 = self::$var1; => atribuição inválida

    public $var5 = myConstant; // declaração com constante (deve ser evitada)

    public $var6 = [true, false]; // declaração com array
}