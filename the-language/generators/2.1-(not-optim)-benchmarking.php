<?php

// BENCHMARKING COM ITERAÇÕES QUE FAZEM USO DE ITERAÇÕES SIMPLES E OUTRAS COM GENERATORS

// Exemplo 1: Gerar registros e formatá-los como exemplo de operações com gasto grande de memória
function getRecords()
{
    $records = [];

    for ($i = 0; $i < 10000; $i++) {
        $records[] = "record $i";
    }

    return $records;
}

function fmtRecords($records)
{
    $new = [];

    foreach ($records as $key => $value) {
        $new[] = "[$key] => {$value}";
    }

    return $new;
}

$records = fmtRecords(getRecords());

// bcdiv => da biblioteca php-bcmath
// 1048576 => 1 MB = 1024 KB => 1024 * 1024 bytes = 1048576 bytes
echo "Memory: ". bcdiv(memory_get_peak_usage(), 1048576, 2) . " MB\n";

/*
Memory: 2.21 MB
*/