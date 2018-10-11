<?php

// CLASS ABSTRACTION
// (*) Classe e métodos abstratos NÃO PODEM SER INSTANCIADOS
// (*) Qualquer classe que contenha ao menos 1 MÉTODO ABSTRATO TAMBÉM DEVE SER ABSTRATA
// (*) Métodos abstratos só podem ser definidos como `public` ou `protected` 

// Em relação às classes herdadas
// (*) Todos os métodos marcados como abstratos na declaração pai devem ser implementados na classe filha
// (*) Métodos definidos como abstratos devem ter suas implementações com A MESMA OU MENOR RESTRIÇÃO DE VISIBILIDADE
//     Esquema: se o método for abstrato protegido => o método implementado deve ser ou protegido ou público. NUNCA PRIVADO!!!
// (*) Assinatura dos métodos implementados devem ter a mesma quantidade ou incrementação de mais argumentos opcionais 
//     com métodos definidos como abstratos

// Exemplo 1: Classe abstrata simples
abstract class AbstractClass
{
    abstract protected function getValue();
    abstract protected function valueWithPrefix($prefix);

    // Método comum
    public function print()
    {
        print($this->getValue() . "\n");
    } 
}

// Classe concreta baseada na de cima
class ConcreteClassA extends AbstractClass
{
    protected function getValue()
    {
        return 'ConcreteClassA';
    }

    // Nota-se que a função abaixo possui menos restrição de visibilidade
    // do que a função definida como abstrata, originalmente protected
    public function valueWithPrefix($prefix)
    {
        return "{$prefix}ConcreteClassA";
    }
}

$classA = new ConcreteClassA();
$classA->print();                               // ConcreteClassA
echo $classA->valueWithPrefix('FOO_') . "\n";   // FOO_ConcreteClassA

// Exemplo 2: Classe abstrata com classe de implementação com método com mais argumentos que a assinatura original
abstract class AbstractClassB
{
    abstract protected function prefixName($name);
}

class ConcreteClassB extends AbstractClassB
{
    // A definição tem somente 1 argumento. No entanto, é possível criar mais argumentos opcionais que não existem
    // na assinatura abstrata.
    // IMPORTANTE => ARGUMENTOS EXTRAS DEVEM SER OPCIONAIS E NÃO OBIGRATÓRIOS, POIS ENTRAM EM DESACORDO
    //               COM A ASSINATURA ORIGINAL
    public function prefixName($name, $separator = ".")
    {
        if ($name == "Pacman") {
            $prefix = "Mr";
        } elseif ($name == "Pacwoman") {
            $prefix = "Mrs";
        } else {
            $prefix = "";
        }

        return "{$prefix}{$separator} {$name}";
    }
}

$class = new ConcreteClassB();
echo $class->prefixName("Pacman") . "\n";       // Mr. Pacman
echo $class->prefixName("Pacwoman") . "\n";     // Mrs. Pacwoman