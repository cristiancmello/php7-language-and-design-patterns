<?php

// EXCEPTIONS
// PHP possui um mecanismo de exceções similar aos de outras linguagens de programação.

// Bloco `try`
// Precisa ter pelo menos um bloco `catch` ou `finally` correspondente

// Objeto lançado com a palavra `throw` precisa ser estendido ou instância da classe `Exception`
// ou subclasse da mesma. NÃO É POSSÍVEL ESTENDER CLASSES DE ERRORS (SÃO INTERNOS AO PHP).

// Bloco `catch`
// (*) Podemos utilizar vários blocos `catch` para capturar exceções diferentes
// (*) Podemos LANÇAR ou RELANÇAR exceções
// (*) Caso uma exceção seja lançada e não tenha um bloco catch para captura correspondente, uma
//     exceção com a mensagem é lançada "Uncaught Exception ..." se uma função manipuladora não for definida
//     em `set_exception_handler()`.

// Bloco `finally`
// (*) Pode ser usado no lugar de `catch`
// (*) O código aqui executa depois do `try` ou `catch`, INDEPENDENTEMENTE SE HOUVE LANÇAMENTO DE EXCEÇÃO

// IMPORTANTE
// (*) FUNÇÕES INTERNAS DO PHP LANÇAM AVISOS DE ERROS (WARNINGS)
// (*) SOMENTE EXTENSÕES ORIENTADAS A OBJETO UTILIZAM EXCEÇÕES
// (*) ERROS PODEM SER TRADUZIDOS PARA EXCEÇÕES COM USO DE `ErrorException`

// Exemplo 1: Lançando uma exceção
function inverse($x) {
    if (!$x) {
        throw new Exception('Division by Zero');
    }

    return 1 / $x;
}

try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo "Exceção capturada: {$e->getMessage()}\n";
}

echo "Hello, World!\n";

/*
0.2
Exceção capturada: Division by Zero
Hello, World!
*/

// Exemplo 2: Manipulação de exceções com bloco `finally`
try {
    echo inverse(5) . "\n";
} catch (Exception $e) {
    echo "Exceção capturada: {$e->getMessage()}\n";
} finally {
    echo "Primeiro finally.\n";
}

echo "Hello, World!\n";

/*
0.2
Primeiro finally.
Hello, World!
*/

// Exemplo 3: Exceções empilhadas, ou melhor, repassando exceções
class MyException extends Exception {}

class Test
{
    public function testing()
    {
        try {
            try {
                throw new MyException('foo!');
            } catch (MyException $e) {
                throw $e;   // relança a exceção para o bloco "pai"
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}

(new Test)->testing();

/*
string(4) "foo!"
*/