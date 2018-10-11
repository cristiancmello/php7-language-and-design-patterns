<?php

// CONSTRUCTOR
// É o método chamado a cada instanciação de uma classe. É apropriado para inicialização do objeto.

// Exemplo 1: exemplo simples de uso de constructor
class BaseClassA
{
    function __construct()
    {
        print("In " . get_class($this) . " constructor.\n"); // In BaseClassA constructor.
    }
}

class SubClassA extends BaseClassA
{
    /* Na classe filha, o método construtor do pai pode sofrer override */
    function __construct()
    {
        parent::__construct(); // chamada ao construtor do pai
        print("In " . get_class($this) . " constructor.\n");
    }
}

$obj1 = new BaseClassA(); // In BaseClassA constructor.
$obj2 = new SubClassA();  // In SubClassA constructor.\nIn SubClassA constructor.

/*
    !!! IMPORTANTE E MUITO CUIDADO !!!
    O caso acima demonstra um comportamento da pseudo-variável $this.
    O constructor da SubClassA faz chamada ao construtor de sua classe pai, a BaseClassA
    que, por sua vez, imprime na tela o nome da classe associada a referência de classe $this.
    Em seguida, o construtor da classe filha, após chamada ao construtor pai, imprime novamente
    o nome da classe do contexto $this.
    
    Logo, o $this reflete o contexto de classe no método chamador. Se é solicitado do contexto
    da classe filha, tentar obter a chamada no construtor pai ainda irá refletir o contexto
    da classe filha chamadora. Por isso há uma repetição das mensagens no exemplo acima.
 */

 // Exemplo 2: Se o construtor da classe pai for `private`, a filha não poderá herdá-lo
class BaseClassB
{
    private function __construct()
    {
        print("In BaseClassB.\n");
    }
}

class SubClassB extends BaseClassB
{

}

// $obj3 = new SubClassB(); => caso seja descomentado, um erro fatal será lançado
// pois o construtor da classe pai é privado.