<?php

// OBJECT INTERFACES
// Interfaces definem quais métodos uma classe deve implementar, mas sem dar a implementação dos mesmos.
// TODOS OS MÉTODOS DECLARADOS NUMA INTERFACE DEVEM SER PÚBLICOS (que é a natureza da interface)

// Operador `implements`
// Serve para implementar os métodos definidos numa interface para uma determinada classe.
// (*) TODOS OS MÉTODOS NA INTERFACE DEVEM SER IMPLEMENTADOS;
// (*) CLASSES PODEM TER N INTERFACES;
// (*) Interfaces suportam herança com operador `extends`
// (*) É permitida a duplicação da assinatura de métodos de interfaces implementados numa classe, devendo serem idênticos

// Constantes em Interfaces
// É possível ter constantes em interfaces. Diferentemente das classes, NÃO PODEM SOFRER OVERRIDE por uma classe/interface herdeira

// Construtor
// INTERFACE PODE DEFINIR CONSTRUTOR. Pode ser útil para criação do padrão Factory

// Exemplo 1: Usando interface para definir métodos de classe de renderização de template HTML
interface ITemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

class Template implements ITemplate
{
    private $vars = [];

    public function setVariable($name, $var)
    {
        $this->vars[$name] = $var;
    }

    public function getHtml($template)
    {
        foreach ($this->vars as $name => $value) {
            $template = str_replace('{'.$name.'}', $value, $template);
        }

        return $template;
    }
}

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>{title}</h1>
</body>
</html>
HTML;

$template = new Template();
$template->setVariable('title', 'Hello, World!');
print($template->getHtml($html) . "\n");

/*
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hello, World!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Hello, World!</h1>
</body>
</html>
*/

// Exemplo 2: Interface com herança
class Baz {}
class Foo {}

interface IA
{
    public function foo();
}

interface IB extends IA
{
    public function baz(Baz $baz);
}

class IC implements IB
{
    public function foo()
    {
    }

    // O método abaixo possui a mesma assinatura do método definido na interface IB
    public function baz(Baz $baz)
    {
    }
}

// Exemplo 3: Interface com herança múltipla
interface A
{
    public function foo();
}

interface B
{
    public function bar();
}

interface C extends A, B
{
    public function baz();
}

class D implements C
{
    public function foo(){}

    public function bar(){}

    public function baz(){}
}

// Exemplo 4: Definição de método construtor numa interface
interface IInterface
{
    public function __construct($name);
}

class ImplementsInterface implements IInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

// Exemplo 5: Interface com constantes
interface IConstants
{
    const b = 'Interface constant';
}

echo IConstants::b . "\n";  // Interface constant

// NÃO É POSSÍVEL FAZER OVERRIDE EM CONSTANTES
class ImplementsConstants implements IConstants
{
    const b = 'Class constant';
}

/* 
O código acima irá lançar um erro fatal
PHP Fatal error:  Cannot inherit previously-inherited or override constant b from interface IConstants
*/