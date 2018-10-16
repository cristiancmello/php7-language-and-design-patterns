<?php

// NAMESPACES OVERVIEW
// Assim como um sistema operacional utiliza sistema de diretórios para organizar arquivos,
// em PHP é possível organizar e encapsular usando o conceito de namespaces.
// Namespaces servem para resolver 2 problemas comuns a criadores de bibliotecas:
// (*) Evitar colisão de nomes entre o código criado e entidades internas do PHP;
// (*) Promover melhor leitura do código-fonte, com o uso de apelidos;

// Exemplo 1: Incluindo arquivo contendo especificação de um namespace
include('2-definition.php');

$conn = new My\Project\Connection(); // instanciar classe contida num namespace
echo My\Project\CONNECT_OK . "\n";   // 1
My\Project\connection(); // chamada a uma função contida num namespace

// Exemplo 3: Definindo múltiplos namespaces num mesmo arquivo
include ('3-definition-multiple.php');

echo MyProjectA\MY_CONST . "\n";    // 1
echo MyProjectB\MY_CONST . "\n";    // 2

// Nomes Desqualificados, Qualificados e Totalmente Qualificados
// Visite o arquivo '3-definition-multiple.php' para mais detalhes
Foo\test();