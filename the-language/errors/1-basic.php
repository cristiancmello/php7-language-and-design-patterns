<?php

// ERRORS
// PHP gerará erros devido a inúmeras condições de erro internas.
// Lista de erros internos: <https://secure.php.net/manual/pt_BR/errorfunc.constants.php>

// Manuseando erros em PHP
// (*) Se nenhum manipulador de erros for configurado, o PHP tratará todos os que ocorrerem de acordo com sua configuração;
// (*) Diretiva `error_reporting` (php.ini): erros controlados e ignorados são definidos por essa diretiva
// (*) Função runtime `error_reporting()`: alternativa à diretiva `error_reporting`
// (*) Diretiva `display_errors`: controla se o erro será mostrado no output do script
// (*) Diretiva `log_errors`: logará (gerar log) qualquer erro para um arquivo ou syslog definido com a diretiva `error_log`

// Considerações para ambiente de desenvolvimento
// 1. Sempre devemos definir `error_reporting` para E_ALL (para sempre estar ciente, alem de corrigir erros info. pelo PHP);
// 2. É útil habilitar `display_errors`, já que garante reporte imediato de problemas

// Considerações para ambiente de produção
// 1. Podemos definir `error_reporting` para E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED (forma menos verbosa). No entanto, podemos
//    definir E_ALL para nos antecipar de avisos de problemas em potencial
// 2. A diretiva `display_errors` SEMPRE DEVE ESTAR DESATIVADA, para prevenir exposição de dados de config. sensíveis (credenciais de DB, ...)
// 3. Habilitar a diretiva `log_errors` pode ser útil para gerar relatórios de erros


// Manipuladores de erros personalizados
// Se dada uma circunstância o manipulador padrão do PHP for inadequado, podemos manipular diversos erros com
// a função `set_error_handler()`. Mas é preciso atenção, pois desde o PHP 7 a maioria dos erros são tratados com lançamento de exceções Error
// vide '2-php7.php'