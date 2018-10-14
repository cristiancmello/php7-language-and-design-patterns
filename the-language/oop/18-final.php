<?php

// FINAL
// (*) Previne que classes herdeiras sobrescrevam um método que seja prefixado como `final`.
// (*) Se a própria classe for `final`, ela não pode ser estendida
// (*) SOMENTE CLASSES E MÉTODOS PODEM SER FINAL. PROPRIEDADES NUNCA PODERÃO SER FINAL.

// Exemplo 1: Métodos final
class BaseClass
{
    final public function test()
    {
        echo "BaseClass::test()\n";
    }

    public function canBeOverwritten()
    {
        echo "BaseClass::canBeOverwritten()\n";
    }
}

class ExtentedClass extends BaseClass
{
    public function canBeOverwritten()
    {
        echo "ExtentedClass::canBeOverwritten()\n";
    }

    // Caso seja descomentado, ocorrerá:
    // PHP Fatal error:  Cannot override final method BaseClass::test()
    // public function test()
    // {
    //     echo "BaseClass::test()\n";
    // }
}

// Exemplo 2: uma classe final
final class BaseFinalClass
{
    // TANTO FAZ UTILIZAR `final` NUMA CLASSE FINAL
    final public function test()
    {
        echo "BaseClass::test()\n";
    }

    public function canBeOverwritten()
    {
        echo "BaseClass::canBeOverwritten()\n";
    }
}

// Caso descomente a linha abaixo, ocorrerá:
// PHP Fatal error:  Class ExtendedFinalClass may not inherit from final class (BaseFinalClass)
// class ExtendedFinalClass extends BaseFinalClass { }