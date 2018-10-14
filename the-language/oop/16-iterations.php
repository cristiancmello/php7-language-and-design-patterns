<?php

// OBJECT ITERACTION
// PHP fornece uma maneira de definir objetos que sejam possíveis iterar numa lista de itens,
// com o uso de foreach, por exemplo.
// IMPORTANTE: por padrão, TODAS AS PROPRIEDADES VISÍVEIS SERÃO UTILIZADA PARA ITERAÇÃO

// Uma alternativa ao uso de iteradores => Generators <https://secure.php.net/manual/pt_BR/language.generators.php>

// Exemplo 1: iteração simples de objetos
class MyClass
{
    public $var1 = 'value 1';
    public $var2 = 'value 2';
    public $var3 = 'value 3';

    protected $protected = 'protected var';
    private   $private   = 'private var';

    function iterableVisible()
    {
        echo "MyClass::iterableVisible:\n";

        foreach ($this as $key => $value) {
            print("$key => $value\n");
        }
    }
}

$class = new MyClass();

// Imprimir atributos visíveis do lado de fora
foreach ($class as $key => $value) {
    print("$key => $value\n");
}

echo "\n";

// Imprimir atributos a partir de um método interno à classe
$class->iterableVisible();

/*
var1 => value 1
var2 => value 2
var3 => value 3

MyClass::iterableVisible:
var1 => value 1
var2 => value 2
var3 => value 3
protected => protected var
private => private var
*/

// Uso da interface Iterator
// Com implementação da interface Iterator, podemos definir como o objeto será iterado e quais
// valores estarão disponíveis em cada iteração.

// Exemplo 2: Iteração de objeto implementando Iterator
class MyIterator implements Iterator
{
    private $var = []; // armazena valores do array passado no construtor

    public function __construct($array)
    {
        if (is_array($array)) {
            $this->var = $array;
        }
    }

    public function rewind()
    {
        echo "rewinding\n";
        reset($this->var);
    }

    public function current()
    {
        $var = current($this->var);
        echo "current: $var\n";
        return $var;
    }

    public function key()
    {
        $var = key($this->var);
        echo "key: $var\n";
        return $var;
    }

    public function next()
    {
        $var = next($this->var);
        echo "next: $var\n";
        return $var;
    }

    public function valid()
    {
        $key = key($this->var);
        $var = ($key !== null && $key !== false); // chave não é idêntica a NULL E a chave não é idêntica a FALSE
        echo "valid: $var\n";
        return $var;
    }
}

$values = [1, 2, 3];
$it = new MyIterator($values);

foreach ($it as $key => $value) {
    print "$key: $value\n---\n";
}

/*
rewinding
valid: 1
current: 1
key: 0
0: 1
---
next: 2
valid: 1
current: 2
key: 1
1: 2
---
next: 3
valid: 1
current: 3
key: 2
2: 3
---
next:
valid:
*/

// Uso da interface IteratorAggregate
// A Interface IteratorAggregate pode ser usado ao invés de implementar todos os métodos de Iterator.
// IteratorAggregate somente exige a implementação do método IteratorAggregate::getIterator(),
// que retorna uma instância de uma classe que implementa a interface Iterator.

// Exemplo 3: Iteração de objeto implementando IteratorAggregate
class MyCollection implements IteratorAggregate
{
    private $items = [];
    private $count = 0;

    public function getIterator()
    {
        return new MyIterator($this->items);
    }

    public function add($value)
    {
        $this->items[$this->count++] = $value;
    }
}

$collection = new MyCollection();
$collection->add('value 1');
$collection->add('value 2');
$collection->add('value 3');

foreach ($collection as $key => $value) {
    echo "key/value: [$key -> $value]\n---\n";
}

/*
rewinding
valid: 1
current: value 1
key: 0
key/value: [0 -> value 1]
---
next: value 2
valid: 1
current: value 2
key: 1
key/value: [1 -> value 2]
---
next: value 3
valid: 1
current: value 3
key: 2
key/value: [2 -> value 3]
---
next:
valid:
*/

// SPL Iterators
// SPL (Standard PHP Library) possui um conjunto de entidades
// para resolução de problemas padrões em PHP (algoritmos, estruturas de dados, ...).
// Ref.: <https://secure.php.net/manual/pt_BR/book.spl.php>

// Exemplo 4: Uso da função iterator_apply (da SPL). É interessante notar
// que um problema que poderia usar a função array_map diretamente num array
// foi transformado num problema de orientação a objeto puro.
function print_caps(Iterator $iterator) {
    echo strtoupper($iterator->current()) . "\n";
    return true;
}

$it = new ArrayIterator(['apples', 'bananas', 'cherries']);
iterator_apply($it, 'print_caps', [$it]);

/*
APPLES
BANANAS
CHERRIES
*/