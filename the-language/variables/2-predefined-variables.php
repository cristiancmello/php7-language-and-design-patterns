<?php

// Predefined Variables
// PHP oferece um grande número de variávels pré-definidas para qualquer script.
// No entanto, muitas vão estar disponíveis dependendo do ambiente e contexto.
// No PHP-CLI, muitas variáveis de ambiente não estão disponíveis.

// AVISO: PHP > v4.2.0 => a diretiva `register_globals` é `off` por padrão.
//        Logo, $_ENV['HOME'] é aceito e $HOME não é mais aceito, como exemplo.

// IMPORTANTE: ARRAYS "SUPERGLOBAIS" => são definidas somente pela linguagem PHP.
//             (*) $HTTP_*_VARS : deprecada
print_r($GLOBALS); // imprimir todas as variáveis de escopo global

echo "Versão do PHP utilizado: ".$_SERVER['PHP_VERSION']."\n"; // Versão... 7.2...

print_r($argv); // Array ( [0] => 2-predefined-variables.php )
