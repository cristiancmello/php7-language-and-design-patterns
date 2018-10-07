<?php

// Constants
// É um identificador (nome) para um valor único. Não pode mudar em tempo de execução,
// exceto as constantes mágicas (que nem são consideradas constantes de verdade).
// As constantes são case-sensitive por padrão.

// Por convenção, identificadores de constantes são sempre MAIÚSCULAS.
// Regra de nomeação é a mesma para qualquer label do PHP.

// Exemplos de nomes válidos e inválidos
define("FOO", "foo");  // válido
define("2FOO", "foo"); // inválido (se for chamado irá gerar erro de parse)

define("__FOO__", "foo"); // forma desencorajada, pois uma constante mágica pode danificar

echo FOO ."\n"; // foo
echo __FOO__ . "\n"; // foo

define("maçã", "fruta"); // PHP suporta UTF-8 para identificadores de constantes
echo maçã . "\n"; // fruta

define("frutas", [ 'pera', 'melancia', 'morango' ]); // Array também é suportada
print_r(frutas);

// `const`: keyword que também define constante
const CONSTANT_FOO = 'constant foo';
echo CONSTANT_FOO . "\n"; // constant foo

echo Constant . "\n"; // imprime `Constant`. Futuramente isso será tratado como erro.

const ANIMALS = ['dog', 'cat', 'bird'];
echo ANIMALS[2] . "\n"; // bird

// IMPORTANTE: constantes definidas com `define()` ou `const` são declaradas
// no escopo de maior nível, pois são definidas em tempo de interpretação. Isso
// significa que são podem ser declaradas dentro de funções, loops, ifs ou try...catch.

// CONSTANTES DEFINIDAS COM `define()` => PODEM SER CASE-INSENSITIVE
// CONSTANTES DEFINIDAS COM `const`    => SÃO SEMPRE CASE-SENSITIVE

// Magic constants
// O PHP fornece um grande número de constantes predefinidas para qualquer script
// que execute. A maioria dessas constantes, entretanto, são criadas por várias
// extensões, e estarão presentes somente quando essas extensões estiverem disponíveis,
// tanto por carregamento dinâmico quanto por compilação direta.

// Algumas constantes mágicas notáveis
echo __LINE__ . "\n"; // 49 -> número da linha desta instrução no arquivo

class Foo {}

// A constante mágica é muito difundida
echo Foo::class . "\n"; // Foo
