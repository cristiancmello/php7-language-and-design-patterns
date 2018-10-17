<?php

// Exemplo 2: Refatoração do Exemplo 1 utilizando Generators
function getRecordsOptim()
{
    for ($i = 0; $i < 10000; $i++) {
        yield "record $i";
    }
}

function fmtRecordsOptim($records)
{
    foreach ($records as $key => $value) {
        yield "[$key] => {$value}";
    }
}

$records = fmtRecordsOptim(getRecordsOptim());

echo "Memory: ". bcdiv(memory_get_peak_usage(), 1048576, 2) . " MB\n";

/*
Memory: 0.40 MB
*/