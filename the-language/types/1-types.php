<?php

// PHP suporta 10 tipos primitivos
// 4 escalares: {boolean, integer, float (ou double por razões históricas), string}
// 4 compostos: {array, object, callable, iterable} -> isto é, formado por porções escalares
// 2 tipos especiais: {resource, NULL}

// Pseudo-tipos por razões de leitura: {mixed, number, callback (aka callable), array|object, void}
// Pseudo-variável: {$...}

// IMPORTANTE: em PHP, não é possível declarar o tipo de variável. O interpretador
// define em runtime

// Checar tipo e valor de uma expressão
$a_bool = TRUE; // boolean

var_dump($a_bool); // imprime `bool(true)`

// Legível para humanos
echo gettype($a_bool);  // imprime `boolean`

$a_str = "foo"; // string
echo "\n"; // new line
echo gettype($a_str); // `string`

// `is_int()` : verificar se variável é um integer
$a_int = 12;
echo "\n";
echo is_int($a_int); // `1`

// `is_string()`: verifica se é uma string
echo "\n";
echo is_string($a_str); // `1`

// Configurar tipo de variável (modo forçado)
echo "\n";
settype($a_str, "integer");
echo gettype($a_str)."\n"; // `integer`

// Booleans
// Expressa um valor de verdade. Pode ser TRUE ou FALSE (são case-insensitive)
$a_bool = true; $a_bool = True; $a_bool = tRuE;

// Casting para Boolean
echo gettype((bool) "")."\n"; // `boolean`
echo gettype((boolean) 3.14)."\n"; // `boolean`

/* É considerado como FALSE:
 * FALSE booleano
 * integer 0
 * float 0.0
 * string "" e "0"
 * array [] ou array() -> com zero elementos
 * NULL (incluindo variável não definida)
 * objetos SimpleXML de tags vazias
 */
$equivalents = false == !(0 == (0.0 == !("" == ("0" == !([] == NULL)))));
var_dump($equivalents); // `bool(true)`

/* Todo o resto é considerado TRUE (inclusive resource e NAN) */

// Integers
// É um número na reta dos inteiros ℤ = {..., -2, -1, 0, 1, 2, ...}

// Podemos representar como:
$a_int = 1234; // decimal
$a_int = -123; // decimal negativo
$a_int = 0xFFF; // hexadecimal
$a_int = 0b101011; // binário

// Comprimento do inteiro dependerá da arquitetura do SO/CPU
// Atualmente, a grande maioria dos sistemas são de 64-bit
$large_number = 2147483648;
var_dump($large_number); // `int(2147483648)` -> com estouro em 32-bit continua sendo inteiro

$large_number = 9223372036854775808;
var_dump($large_number); // `double(9.2233720368548E+18)` -> estouro em integer forçou casting para float/double

// NÃO EXISTE DIVISÃO INTEIRA EM PHP
// Qualquer operação de divisão resulta num valor float/double
var_dump(1/2); // `double(0.5)`
var_dump((int) (1/2)); // `int(0)`
var_dump(round(1/2)); // `double(1)` -> round() é função de teto

// Real numbers
// Seguem a sintaxe
$a = 1.14;
$b = 1.2e3; // 1.2 * 10^3
$c = 7E-10; // 7 * 10^(-10)

/* IMPORTANTE: PHP usa precisão do IEEE 754. No entanto, há falta de
   confiabilidade nos resultados e comparações devido a perda de precisão.

   Há 2 soluções para resolver esses problemas:
    * GMP functions: https://secure.php.net/manual/en/ref.gmp.php
    * BC Math Functions: https://secure.php.net/manual/en/ref.bc.php
*/

// NaN (Not a Number)
// Algumas operações podem resultar em NAN
echo is_nan(NAN); // `1`

// Strings
// É uma sequência de caracteres.
// A codificação dependerá da codificação do arquivo do script e se Zend Multibyte
// estiver habilitado.
// A grande maioria dos sistemas codifica os scripts PHP como Unicode
// Em PHP 7 em sistemas de 64-bit, não existe limite em RAM para a string

// Single quoted
echo "\n";
echo 'this is a simple string';
echo "\n";
echo 'Line 1
Line 2';
echo "\n";

// Single quoted não suporta expansão de caracteres de escape nem de variáveis
echo '\n'; // `\n`
echo "\n"; // Double quotes suporta caractere de escape
echo 'You deleted C:\\*.*'; // `You deleted C:\*.*` -> neste caso imprime '\'

// Double quoted
// caracteres especiais são interpretados
echo "\n"; // Line Feed
echo "\r"; // Carriage Return
echo "\$"; // Dollar sign
echo "\""; // Double-quote
echo "\xFA\n"; // Representação hexadecimal
echo "\u{FF}"; // Imprime Unicode

// Variáveis podem ser expressas
$a_str = "Hello";
echo "\n$a_str\n";

// Heredoc
$name = "Cristian";

$str = <<<EOT
Example of string
snapping multiple lines
using heredoc syntax.

I'am $name
EOT;

echo $str.PHP_EOL; // PHP End Of Line

// Desde PHP 7.1, "" <=> []
$str = "foo";
echo $str[1]."\n"; // `o`

// Nota: Acessar ou modificar uma string usando brackets não são multi-byte safe.
// Isso só deve ser feito com string single-byte com a ISO 8859-1

// Operações com String: concatenação `. e atribuição curta de concatenação `.=`
$a = 'hello'.'world';
$a .= '!';
echo "$a\n"; // `helloworld!`

/*
 FUNÇÕES ÚTEIS : https://secure.php.net/manual/en/ref.strings.php
 URL Functions: https://secure.php.net/manual/en/ref.url.php
 Encrypt/Decrypt String: https://secure.php.net/manual/en/ref.sodium.php e
    https://secure.php.net/manual/en/ref.hash.php
 */

// Arrays
// Em PHP, array é um mapa que relaciona valores e chaves (hash map)
// É otimizado para vários usos: array, lista (vetor), hashtable (impl. de map),
// dicionário, coleção, pilha, fila e etc.
// Destaca-se que array pode ser formado por arrays, árvores ou matrizes

// sintaxe
$array = array(
    'foo' => 'bar',
    'bar' => 'foo'
);

// ou (na forma contraída)
$array = [
    'foo' => 'bar',
    'bar' => 'foo'
];

// Chave: pode ser integer ou string
/*
 * Chave sendo String: '8' é convertido para inteiro 8; '08' => não será convertido;
 * Chave sendo Float: a parte fracionário é removida; '2.17' convertido para inteiro 2;
 * Chave sendo NULL: é convertido para "";
 * Chave sendo array | object: não podem ser usados como chave. Isso provoca em warn 'Illegal offset type';
*/
// Override de valores com mesmas chaves
$array = [
    1 => 'a',
    "1" => 'b',
    1.7 => 'c',
    true => 'd'
];

var_dump($array); // `array(1) { [1] => string(1) "d" }` -> logo, apenas o último valor foi considerado

// PHP NÃO FAZ DISTINÇÃO ENTRE ARRAYS INDEXADOS (USANDO INTEGER) E ASSOCIATIVOS (USAM STRING)
$array = [
    'foo' => 'bar',
    'bar' => 'foo',
    2 => -90,
    -5 => 17
];

var_dump($array);

/*
Saída será:

array(4) {
  'foo' => string(3) "bar"
  'bar' => string(3) "foo"
  [2] => int(-90)
  [-5] => int(17)
}
*/

// Arrays indexados sem chaves: são incrementados a partir de 0 ou posição numérica
// explicitada
$array = ['foo', 'bar', 'hello', 'world'];
var_dump($array);

/*
array(4) {
  [0] => string(3) "foo"
  [1] => string(3) "bar"
  [2] => string(5) "hello"
  [3] => string(5) "world"
}
*/

$array = [
    'foo' => 'bar',
    1 => 'foo',
    -1 => 'hello',
    'world'
];

var_dump($array);

/*
array(3) {
  'foo' => string(3) "bar"
  [1] => string(3) "foo"
  [-1] => string(5) "hello"
  [2] => string(5) "world" ==> O incremento de chave conta com o maior índice de elemento declarado
}
*/

// Acessando elementos do array
$array = [
    'foo' => 'bar',
    'multi' => [
        'dim' => [
            'array' => 'foo'
        ]
    ]
];

var_dump($array['foo']);    // string(3) "bar"
var_dump($array['multi']['dim']['array']); // string(3) "foo"

// Referenciando elemento de um array
function getArray() {
    return [1, 2, 3];
}

echo getArray()[1]."\n"; // `2`
$array = getArray();
echo $array{1}."\n"; // `2` (forma equivalente de obter valor a partir de chave)

// Alternativa usando list
list(, $secondElement) = getArray();
echo $secondElement."\n";

// Mensagem de erro: E_NOTICE com resultado NULL
// echo $array[10]."\n"; -> Undefined offset

// Criando/modificando com a sintaxe de colchetes
$array = [2 => 10, 10 => 30];
$array[] = 56; echo $array[11]."\n"; // `56` -> chave 11 é criada e valorada (NÃO RECOMENDADO)
$array['x'] = 42; echo $array['x']."\n"; // `42` -> elemento é criado dinamicamente

// Remover elemento do array
unset($array['x']);
print_r($array);

/*
Array (
    [2] => 10
    [10] => 30
    [11] => 56
)
*/

// Remover todo o array
unset($array); // variável `$array` fica indefinida

// IMPORTANTE: mesmo apagando o conteúdo do array, as chaves continuam em memória
$array = [1, 2, 3, 4, 5];
foreach ($array as $key => $value) {
    unset($array[$key]);
}

print_r($array); // Array (  )

$array[] = 10; print_r($array); // Array ( [5] => 10 ) -> a última chave indexada foi incrementada

// Reindexando (iniciar nova contagem de chaves)
$array = array_values($array);
$array[] = 7; print_r($array); // Array ( [0] => 10 [1] => 7 )

// Array: faça e não faça

// Mostrando todos os erros
error_reporting(E_ALL); // irá omitir avisos de códigos com más práticas

// A atribuição abaixo
$foo[bar] = 'hello'; // vai provocar warning, pois PHP trata `bar` como constante indedinida
print_r($foo); // futuramente PHP tratará isso como exceção

// Não delimite chaves que sejam constantes ou variáveis, porque isso impedirá
// o PHP de intepretá-las.
$array = ['fruta' => 'maçã', 'legume' => 'cenoura'];
print($array['fruta'])."\n"; // `maçã`
print($array[fruta])."\n"; // `maçã`

define('fruta', 'legume'); // definição de constante chamada `fruta` como sendo `legume`
print($array[fruta])."\n"; // `cenoura` -> ocorre que `fruta` corresponderá a chave `legume`

// Constantes comuns aceitas (MUITO RUIM, pois novas constantes podem ser reservadas na especificação da linguagem)
$error_descriptions[E_ERROR] = 'Erro fatal ocorreu';
$error_descriptions[E_WARNING] = 'O PHP emitiu um alarme';
$error_descriptions[E_NOTICE] = 'Apenas um aviso informal';

print_r($error_descriptions); // Array ( [1] => Erro fatal ocorreu [2] => O PHP emitiu um alarme [8] => ... )

// Casting para array
/*
 * integer, float, string, boolean e resource => será dado (array) $scalarValue <=> array($scalarValue)
 */
print_r((array)56)."\n"; // Array ( [0] => 56 )
print_r((array)[])."\n"; // Array ( )
print_r((array)NULL)."\n"; // Array ( )

class A {
    private $A;
}

class B extends A {
    private $A; // será '\0B\0A'
    public $AA; // será 'AA'
    protected $B; // será '\0*\0B'
}

var_dump((array) new A()); // array(1) { '\0A\0A' => NULL }
var_dump((array) new B()); // array(3) { '\0B\0A' => NULL 'AA' => NULL => '\0A\0A' => NULL }

// Comparando Arrays
// `array_diff( array $arr1, array $arr2 [, array $...] )`
// $arr1: array a ser comparado
// $arrN: um array para comparar
// Retorno: retorna um array com todos os elementos de $arr1 que não estão
// presentes em nenhum dos outros arrays.
$arr1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue'];
$arr2 = ['d' => 'yellow', 'b' => 'green'];
print_r(array_diff($arr1, $arr2)); // Array ( [a] => red [c] => blue )

// Coleção
$colors = ['red', 'green', 'blue'];

foreach ($colors as $color) {
    print("Você gosta de $color?\n");
}

// Alterar valores diretamente usando passagem por referência
// Caso abaixo é um exemplo inalteração de valores sem uso de referência
foreach ($colors as $color) {
    $color = strtoupper($color);
}

print_r($colors)."\n"; // Valores foram preservados

// Usando referência
foreach ($colors as &$color) {
    $color = strtoupper($color);
}

$color = 'YELLOW'; // IMPORTANTE: se não utilizar unset, $color continuará referenciado
unset($color);

// Sem uso direto de referência, a forma abaixo funciona em versões antigas
foreach ($colors as $key => $color) {
    $colors[$key] = strtolower($color);
}

print_r($colors);

// Outro exemplo de uso de referência
$arr1 = [1, 2];
$arr2 = &$arr1;
$arr2[] = 3;
print_r($arr1); // Array ( [0] => 1 [1] => 2 [2] => 3 )


// Preenchendo um array
$handle = opendir('.');

while (false !== ($file = readdir($handle))) {
    $files[] = $file;
}

closedir($handle);
print_r($files); // Array ( [0] => .. [1] => 1-types.php [2] => . )

// ARRAYS SÃO SEMPRE ORDENADOS. É possível mudar a ordenação usando
// funções de ordenação (como `sort()`)

sort($files);
print_r($files); // Array ( [0] => . [1] => .. [2] => 1-types.php )

// Iterables
// É um pseudo-tipo introduzido em PHP 7.1. Aceita qualquer array ou objeto
// que implemente a interface Traversable
// Ambos os tipos são iteráveis usando `foreach`

// Parâmetro Iterable
// Declaração também é permitida: function foo(iterable $iterable = [ [] | NULL ]) {}
function foo(iterable $iterable) {
    foreach ($iterable as $value) {
        print($value)."\n";
    }
}

$fruits = ['apple', 'strawberry', 'pineapple'];
foo($fruits); // apple\nstrawberry\npineapple

// Iterable pode especificar um retorno na função
function bar(): iterable {
    return [1, 2, 3];
}

print_r(bar()); // Array ( [0] => 1 [1] => 2 [2] => 3)

// Iterable generator com retorno especificado
function gen(): iterable {
    yield 1;
    yield 2;
    yield 3;
}

print_r(gen()); // Generator Object ( )

// Variação no tipo Iterable
// Classes herdando/implementando podem ampliar os métodos usando array ou Traversable
// como tipos de parâmetro para iterar.

interface Example {
    public function method(array $array): iterable; // retorno como Traversable
}

class ExampleImpl implements Example {
    public function method(iterable $iterable): array /* Retorno como array */{
        // ...
    }
}

// Objects
// Capítulo inteiro dedicado a OOP: https://secure.php.net/manual/en/language.oop5.php

// Inicialização de objetos
// Para criar novo objeto, é usado o token `new` para instanciar uma classe.
class foo {
    function do_foo() {
        echo "Doing foo.";
    }
}

$bar = new foo; // ou foo()
$bar->do_foo()."\n";

// Convertendo para objeto
$obj = (object) ['1' => 'foo'];
var_dump($obj);

/*
class stdClass#2 (1) {
  public $1 => string(3) "foo"
}
*/

// Verificar se o campo '1' foi definido
// Abaixo há uma estrutura sintática para referenciar campos que possuem nomes como string
// para esse caso específico de casting
var_dump(isset($obj->{'1'})); // bool(true)
var_dump(key($obj)); // string(1) "1"

// Para qualquer outro valor, um membro chamado `scalar` conterá o valor
$obj = (object)'tchau';
print($obj->scalar)."\n"; // tchau

// Resources
// É um tipo especial de variável. Ela mantém uma referência a um recurso externo.
// Resources são criados e usados por funções especiais.

// Resources lidam com manipuladores especiais para arquivos aberto (streams),
// conexões com DB, canvas de imagens e etc

// Alguns tipos de recursos e bibliotecas: aspell, bzip2, gd, gmp, mysql-query, fopen, ...
// Lista em https://secure.php.net/manual/en/resource.php

// `is_resource()`: identifica se a variável é um recurso
$conn = fopen('1-types.php', 'r');
echo is_resource($conn)."\n"; // `1`

// `get_resource_type()`: obter o tipo de resource
echo get_resource_type($conn)."\n"; // `stream`

// Liberando Resources
// DESDE PHP 4 (Zend Engine) => RECURSO É LIBERADO AUTOMATICAMENTE QUANDO A REFERÊNCIA NÃO É MAIS USADA
// EXCEÇÃO: CONEXÕES PERSISTENTES DE BANCOS DE DADOS NÃO SÃO DESTRUÍDAS PELO GARBAGE COLLECTOR

// NULL
// Representa uma variável sem valor
// É O ÚNICO VALOR POSSÍVEL DO TIPO NULL.

// Casos em que uma varável é considerada NULL:
// (1) $var = NULL;
// (2) Ainda não recebeu nenhum valor;
// (3) foi apagada com unset()

$var = null; # ou NULL
echo $var."\n"; // ``

// `is_null()`: verifica se o valor de uma variável é null
echo is_null($var)."\n"; // `1`

// `unset()`: destrói a variável especificada

// Casting para NULL
// Converter variável para null usando `(unset) $var` não a removerá ou apagará
// seu valor. Apenas retornará NULL como valor.
$var = 'foo';
var_dump((unset)$var); // NULL
var_dump($var); // string(3) "foo"
