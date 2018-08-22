<?php

// PHP suporta o operador de execução ``
// Utilizar `` é o mesmo que usar a função `shell_exec()`

$output = `ls -alh`; // lista arquivos do diretório deste script
echo $output . "\n";

// ou
$output = shell_exec('ls -alh'); // lista arquivos do diretório deste script
echo $output . "\n";

// IMPORTANTE: o operador de execução fica desabilitado quando `safe_mode` está
// ativo ou `shell_exec()` está desabilitado.
