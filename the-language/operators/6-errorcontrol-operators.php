<?php

// ErrorControl Operators
// O PHP suporta um operador de controle de erro: `@` (sinal arroba).
// Quando precede uma expressão, qualquer mensagem de erro que possa ser gerada
// por aquela expressão será ignorada.

// Se quisermos configurar uma função personalizada de manipulação de erros com
// `set_error_handler()` ela será chamada, mas esta função personalizada deve
// chamar `error_reporting()` que irá retornar zero quando o erro disparado
// tiver sido precedido por um `@`.

// Se o recurso `track_errors` estiver habilitado, qualquer mensagem de erro
// gerada pela expressão será grava na variável `$php_errormsg`. A cada
// erro gerado a variável é sobrescrita.

// IMPORTANTE: $php_errormsg está deprecado em PHP >= 7.2

// Erro intencional
$file = @file('notfound') or die("Falha ao abrir arquivo.".error_get_last()['message']);

// Mensagem: Falha ao abrir arquivo.file(notfound): failed to open stream: No such file or directory⏎

// Podemos usar `@` para qualquer expressão
$value = @$cache[$key];

// LUGARES QUE NÃO PODEMOS USAR `@`: funções, classes, estruturas condicionais e de repetição

// AVISO: o operador `@` sempre desativa mensagens de erro, mesmo para erros críticos
// que terminam com a execução de scripts.
