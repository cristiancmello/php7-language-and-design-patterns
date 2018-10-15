<?php

// Captura de eventos de serialização e desserialização com `__sleep()` e `__wakeup()`

// Exemplo 3: Exemplo simples de aplicação dos métodos mágicos `__sleep()` e `__wakeup()`
class A
{
    public $foo = 1;

    public function showFoo()
    {
        echo $this->foo . "\n";
    }

    // Com método mágico __sleep(), podemos definir os atributos
    // que podem ser serializados.
    // IMPORTANTE: __sleep() está relacionado a tarefas do tipo "save and exit"
    public function __sleep()
    {
        return []; // Com esse retorno, definimos que NENHUM atributo será serializado
    }

    // Com método mágico __wakeup(), podemos definir o comportamento
    // na fase de desserialização do objeto.
    // IMPORTANTE: __wakeup() está relacionado a tarefas do tipo "open and start"
    public function __wakeup()
    {
        $this->foo = 'hello';
    }
}

// Serialização e desserialização
$a = new A();
$s = serialize($a);

$a = unserialize($s);
echo $a->foo . "\n";    // hello


// Exemplo 4: Demonstração de manipulação das fases de `__sleep()` e `__wakeup()`
class Person
{
    private $name;
    private $address;
    private $gender;

    public function __construct($name, $address, $gender)
    {
        $this->name = $name;
        $this->address = $address;
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function __sleep()
    {
        // Definimos um processo para "encurtar" representação de gênero
        // antes de serializar o objeto
        switch ($this->gender) {
            case "male":
                $this->gender = "m";
                break;
            case "female":
                $this->gender = "f";
                break;
            default:
                $this->gender = "undefined";
        }

        return array_keys(get_object_vars($this)); // obter todas as chaves do objeto e retorná-las
    }

    public function __wakeup()
    {
        // Definimos um processo para "expandir" representação de gênero
        // após a desserialização do objeto
        switch ($this->gender) {
            case "m":
                $this->gender = "male";
                break;
            case "f":
                $this->gender = "female";
                break;
            default:
                $this->gender = "undefined";
        }
    }
}

$person = new Person('John Doe', 'Street A', 'male');
$s = serialize($person);

$person = unserialize($s);
echo $person->getGender() . "\n";   // male