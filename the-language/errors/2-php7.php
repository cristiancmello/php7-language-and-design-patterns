<?php

// ERRORS IN PHP 7
// (*) PHP mudou como a maioria dos erros são reportados pelo PHP.
// (*) ERROS AGORA SÃO LANÇADOS COMO EXCEÇÕES 'Error'

// Hierarquia de erros (versão mais simples)
/* 
Throwable (Interface)
    Error (ArithmeticError, AssertionError, CompileError, TypeError)
    Exception (Diversos erros diferentes da classe Error)

Em PHP 7, podemos tratar ambos os throwables como

try
{
   // Code that may throw an Exception or Error.
}
catch (Throwable $t)
{
   // Executed only in PHP 7, will not match in PHP 5
}
*/
