<?php

// Bitwise Operators
// Operadores bit a bit permitem avaliação de bits específicos em um tipo
// inteiro.

// AND
$a = 0b0001;
$b = 0b0010;
$r = $a & $b;

printf("%1$04b \n", $r); // 0000

// OR (INCLUSIVE)
$a = 0b0011;
$b = 0b0001;
$r = $a | $b;

printf("%1$04b \n", $r); // 0011

// XOR (EXCLUSIVE OR)
$a = 0b0011;
$b = 0b0001;
$r = $a ^ $b;

printf("%1$04b \n", $r); // 0010

// NOT
$a = 0b0001;
$r = ~$a;

printf("%1$04b \n", $r); // 1111111111111111111111111111111111111111111111111111111111111110

// SHIFT LEFT
$a = 0b0001;
$b = 2;
$r = $a << $b;

printf("%1$04b \n", $r); // 0100 (equivale a multiplicação por 2)

// SHIFT RIGHT
$a = 0b0100;
$b = 2;
$r = $a >> $b;

printf("%1$04b \n", $r); // 0001 (equivale a divisão por 2)

// Bitwise entre strings
$a = "b";     // decimal(98)
$b = "_";     // decimal(95)
$r = $a & $b; // decimal(98) AND decimal(95) = decimal(66) = 'B' em ASCII

echo $r . "\n"; // B

// IMPORTANTE: não desloque inteiro em quantidade maior ou igual ao long int
// da arquitetura do sistema. Se o sistema for de 64 bits, não faça operações
// maiores que 63 bits. Caso contrário, produzirá comportamento indefinido.

// A extensão `gmp` fornece manipulações de troca de bit maiores que o inteiro
// PHP_INT_MAX.

// A seguir, estão códigos interessantes de simulações de blocos funcionais
// de uma ALU (Unidade Lógica e Aritmética).
function half_adder($a, $b): array {
    $xor = $a ^ $b;
    $and = $a & $b;

    return [
        'S' => $xor,
        'C' => $and
    ];
}

$result = half_adder(0b0001, 0b0001);
print_r($result);


function full_adder_1_bit($a, $b, $c_in): array {
    $xor_0 = $a ^ $b;
    $xor_1 = $xor_0 ^ $c_in;
    $S = $xor_1;

    $and_0 = $xor_0 & $c_in;
    $and_1 = $a & $b;
    $or_0 = $and_0 | $and_1;

    $C_out = $or_0;

    return [
        'S' => $S,
        'C_out' => $C_out
    ];
}

function full_adder_4_bits($arr_a, $arr_b, $c_in): array {
    $arr_a = array_reverse($arr_a);
    $arr_b = array_reverse($arr_b);

    $out_0 = full_adder_1_bit($arr_a[0], $arr_b[0], $c_in);
    $out_1 = full_adder_1_bit($arr_a[1], $arr_b[1], $out_0['C_out']);
    $out_2 = full_adder_1_bit($arr_a[2], $arr_b[2], $out_1['C_out']);
    $out_3 = full_adder_1_bit($arr_a[3], $arr_b[3], $out_2['C_out']);

    return [
        'S0' => $out_0['S'],
        'S1' => $out_1['S'],
        'S2' => $out_2['S'],
        'S3' => $out_3['S']
    ];
}

$result = full_adder_4_bits(
    [0, 1, 1, 1], // decimal(7) = bin(0111)
    [0, 0, 0, 1], // decimal(1) = bin(0001)
    0 // carry in
);

print_r(array_reverse($result));

/*
Array
(
    [S3] => 1
    [S2] => 0
    [S1] => 0
    [S0] => 0
)

bin(1000) = decimal(8)
*/
