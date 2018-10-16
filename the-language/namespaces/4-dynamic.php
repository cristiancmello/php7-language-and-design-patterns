<?php

// NAMESPACES AND DYNAMIC LANGUAGE FEATURES

// Exemplo 1: Acessando dinamicamente elementos
namespace namespacename;

class classname
{
    function __construct()
    {
        echo __METHOD__,"\n";
    }
}

function funcname()
{
    echo __FUNCTION__,"\n";
}

const constname = "namespaced";

/* se for utilizado double-quotes (""), "\\namespacename\\classname" deve ser usado */
$a = '\namespacename\classname';
$obj = new $a; // prints namespacename\classname::__construct
$a = 'namespacename\classname';
$obj = new $a; // also prints namespacename\classname::__construct
$b = 'namespacename\funcname';
$b(); // prints namespacename\funcname
$b = '\namespacename\funcname';
$b(); // also prints namespacename\funcname

echo constant('\namespacename\constname'), "\n"; // prints namespaced
echo constant('namespacename\constname'), "\n";  // also prints namespaced