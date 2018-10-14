<?php

// MAGIC METHODS
// PHP reserva funções iniciadas com "__" como mágicas. Portanto, não se deve nomear funções com essa inicial.
// IMPORTANTE: o próprio construtor das classes é um magic method

// Ref.: <https://secure.php.net/manual/en/language.oop5.overloading.php>

// __toString()
// Método mágico que define comportamento quando um objeto é convertido para string.

// Exemplo 1: uso do __toString()
class MyClass
{
    private $name;

    // Magic method de construtor
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    // Magic method para converter objeto para string
    public function __toString()
    {
        return $this->name;
    }
}

$obj = new MyClass('hello');
echo $obj . "\n"; // hello

// Getters and Setters com __get e __set
// Exemplo 2: definição de getter e setter para propriedades dinâmicas de uma classe

class MyClassA
{
    private $data = [];

    public $default = true; // define valor padrão de um membro que pode ser criado dinamicamente
    private $hidden = true;

    public function __get($name)
    {
        echo "$name: ";
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    // Getter para propriedade privada $hidden
    public function getHidden()
    {
        return $this->hidden;
    }
}

$obj = new MyClassA();
$obj->address = 'Street ...';   // criar propriedade dinamicamente
echo $obj->address . "\n";      // address: Street ....

echo $obj->default . "\n";      // 1 (true)
echo $obj->getHidden() . "\n";  // 1 (true)

// Exemplo 3: Getter and setter mais simples
class Person
{
    private $name;
    private $address;
    private $gender;

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            switch ($name) {
                case "name":
                    $preffix = "Name: ";
                    break;
                case "address":
                    $preffix = "Address: ";
                    break;
                default:
                    return $this->$name;
            }

            return $preffix . $this->$name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }

        return $this;
    }
}

$obj = new Person();
$obj->name = 'John Doe';
$obj->address = 'Street ...';
$obj->gender = 'Male';

echo "$obj->name\n";        // Name: John Doe
echo "$obj->address\n";     // Address: Street ...
echo "$obj->gender\n";      // Male