<?php

// OBJECT CLONING
// Em PHP, é possível definir ou utilizar o conceito de clonagem de objetos.
// Por padrão, a clonagem de objetos consiste na replicação das propriedades.
// Nem sempre a replicação total é desejado. Por isso podemos definir como a operação poderá ser feita.

// Exemplo 1: definição de uma classe e clonagem padrão
class Person
{
    private $name;
    private $address;
    private $gender;

    public function __construct(string $name, string $address, string $gender)
    {
        $this->name = $name;
        $this->address = $address;
        $this->gender = $gender;
    }

    public function __toString()
    {
        return "Name: $this->name\nAddress: $this->address\nGender: $this->gender";
    }
}

$person = new Person('John Doe', 'Street A', 'Male');
echo $person . "\n";

/*
Name: John Doe
Address: Street A
Gender: Male
*/

// Fazer clonagem de $person
$newPerson = clone $person;
echo $newPerson . "\n";

/*
Name: John Doe
Address: Street A
Gender: Male
*/

// Definição do processo de clonagem
// Existe um método mágico chamado `__clone()`.

// Exemplo 2
class MyClonablePerson
{
    private $name;
    private $address;
    private $gender;

    public function __construct(string $name, string $address, string $gender)
    {
        $this->name = $name;
        $this->address = $address;
        $this->gender = $gender;
    }

    public function __clone()
    {
        $this->name = "$this->name (Clone)";
        $this->address = "$this->address (Clone)";
        $this->gender = "$this->gender (Clone)";
    }

    public function __toString()
    {
        return "Name: $this->name\nAddress: $this->address\nGender: $this->gender";
    }
}

$person = new MyClonablePerson('John Doe', 'Street A', 'Male');
$newPerson = clone $person;

echo $newPerson . "\n";

/*
Name: John Doe (Clone)
Address: Street A (Clone)
Gender: Male (Clone)
*/