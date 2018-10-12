<?php

// ANONYMOUS CLASS
// Classes anônimas são úteis quando objetos descartáveis precisam ser criados.

// Exemplo 1.A: Criação de classe de log com classe de util recebendo a instancia de Logger
class Logger
{
    public function log($msg)
    {
        echo "$msg\n";
    }
}

class Util
{
    private $logger;

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}

$util = new Util();
$util->setLogger(new Logger());

// Exemplo 1.B: Exemplo equivalente ao 1.A usando classe anônima
$util->setLogger(new class {
    public function log($msg)
    {
        echo "$msg\n";
    }
});

// Passagem de argumentos através de construtor, herança, implementação de interfaces
// e uso de traits em classes anônimas

// Exemplo 2: Demonstração simples da versatilidade de uma classe anônima
class SomeClass { }
interface SomeInterface { }
trait SomeTrait { }

var_dump(new class(10) extends SomeClass implements SomeInterface {
    use SomeTrait;
    
    private $num;

    public function __construct($num)
    {
        $this->num = $num;
    }
});

/*
class class@anonymous#2 (1) {
  private $num =>
  int(10)
}
 */

// Aninhamento de classes anônimas
// A classe interna não tem direito a acessar membros privados ou protegidos da classe externa.
// Logo, deve ficar sujeita a manipulação por passagem a construtor.
class Outer
{
    private $prop   = 1;
    protected $prop2  = 2;

    protected function func1()
    {
        return 3;
    }

    public function func2()
    {
        // A classe anônima recebe a propriedade da classe externa
        // Somente dessa forma ela terá conhecimento da propriedade privada
        return new class($this->prop) extends Outer {
            private $prop3;

            public function __construct($prop)
            {
                $this->prop3 = $prop;
            }

            public function func3()
            {
                return $this->prop2 + $this->prop3 + $this->func1();
            }
        };
    }
}

echo (new Outer)->func2()->func3() . "\n";  // 6