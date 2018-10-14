<?php

// OBJECT COMPARISON
// (*) <obj1> == <obj2> : variáveis dos objetos serão comparadas de maneira simples, nominalmente.
//                        obj1 é igual a obj2 se possuírem os mesmos valores e atributos, sendo instâncias da mesma classe
//
// (*) <obj1> === <obj2>: variáveis serão idênticas, se e somente se, referirem a mesma instância da mesma classe

// Exemplo 1: demostração de comparações
function bool2str($bool)
{
    if ($bool === false) {
        return 'FALSO';
    } else {
        return 'VERDADEIRO';
    }
}

function compareObjects(&$o1, &$o2)
{
    echo 'o1 == o2 : ' . bool2str($o1 == $o2) . "\n";
    echo 'o1 != o2 : ' . bool2str($o1 != $o2) . "\n";
    echo 'o1 === o2 : ' . bool2str($o1 === $o2) . "\n";
    echo 'o1 !== o2 : ' . bool2str($o1 !== $o2) . "\n";
}

class Flag
{
    public $flag;

    function Flag($flag = true) {
        $this->flag = $flag;
    }
}

class OtherFlag
{
    public $flag;

    function OtherFlag($flag = true) {
        $this->flag = $flag;
    }
}

$o = new Flag();
$p = new Flag();
$q = $o;
$r = new OtherFlag();

echo "Duas instâncias da mesma classe\n";
compareObjects($o, $p);

echo "\nDuas referências para a mesma instância\n";
compareObjects($o, $q);

echo "\nInstâncias de duas classes diferentes\n";
compareObjects($o, $r);

/*
Duas instâncias da mesma classe
o1 == o2 : VERDADEIRO   (são iguais, pois possuem os mesmos valores e atributos, sendo instâncias da mesma classe)
o1 != o2 : FALSO        (não são diferentes, pois possuem mesmos valores e atributos, sendo instâncias da mesma classe)
o1 === o2 : FALSO       (não são idênticos, pois não se referem a mesma instância da mesma classe)
o1 !== o2 : VERDADEIRO  (são não-idênticos, pois não se referem a mesma instância da mesma classe)

Duas referências para a mesma instância
o1 == o2 : VERDADEIRO   (são iguais, pois possuem os mesmos valores e atributos, sendo instâncias da mesma classe)
o1 != o2 : FALSO        (não são diferentes, pois possuem os mesmos valores e atributos, sendo instâncias da mesma classe)
o1 === o2 : VERDADEIRO  (são idênticos, pois se referem a mesma instância da mesma classe, sendo que $q uma referência a $o)
o1 !== o2 : FALSO       (não são não-idênticos, pois se referem a mesma instância da mesma classe)

Instâncias de duas classes diferentes
o1 == o2 : FALSO        (não são iguais, pois não possuem os mesmos valores e atributos, além de serem instâncias de classes diferentes)
o1 != o2 : VERDADEIRO   (são diferentes, pois não possuem os mesmos valores e atributos, além de serem de instâncias de classes diferentes)
o1 === o2 : FALSO       (não são idênticos, pois não se referem a mesma instância da mesma classe)
o1 !== o2 : VERDADEIRO  (são não-idênticos, pois não se referem a mesma instância da mesma classe)
*/