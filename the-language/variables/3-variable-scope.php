<?php

// Variable Scope
// O escopo de uma variável é o contexto onde foi definida. A maioria das em PHP
// tem somente escopo local.

// Escopo local inclui os arquivos incluidos e requeridos
$a = 1;
$c = 3;
include 'b.inc';

echo "(3-variable-scope.php) Local scope after include: \$b = $b"."\n"; // definida em b.inc com valor 2

// Escopo local em funções
// Qualquer variável utilizada dentro de uma função é por padrão delimitada ao
// escopo local da função
function test() {
    echo $a; // aqui dentro esta variável é indefinida (sem output)
}

test();  // emite um E_NOTICE

// Global token
// Diferentemente da linguagem C, em PHP as variáveis globais não estão
// automaticamente disponíveis. Elas precisam ser declaradas como globais.
// IMPORTANTE:
// (1) NÃO HÁ LIMITE PARA NÚMERO DE VARIÁVEIS GLOBAIS.
// (2) O TOKEN `global` deve ser utilizado quando incluir um arquivo.
function sum() {
    global $a, $c; // agora $a estará disponível

    $c += $a;
}

sum();
echo $c."\n"; // 4

// Uso do array global $GLOBALS
// Também se pode utilizar o array global $GLOBALS.
echo $GLOBALS['a']."\n"; // 1

// Inclusão de arquivos dentro de funções
// É preciso declarar com o token `global` para que as funções globais
// sejam especificadas.
function include_globals() {
    include 'b.inc';

    echo $d."\n";
}

// include_globals();

// Utilizando variávels `static`
// Existe somente no escopo local da função, mas persiste seu valor quando
// o nível de execução do programa deixa o escopo.
function counter() {
    static $c = 1;
    return $c++;
}

counter(); counter();
echo counter()."\n"; // 3

// IMPORTANTE: uma variável estática não pode receber uma expressão, somente
// um valor.
// static $int = sqrt(121); // Gera um Fatal error

// MUITO IMPORTANTE: DECLARAÇÕES ESTÁTIAS SÃO RESOLVIDAS EM TEMPO DE COMPILAÇÃO
