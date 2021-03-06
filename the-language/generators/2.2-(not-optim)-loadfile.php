<?php

// Exemplo 3: Carregar um arquivo da forma convencional
// Para gerar o arquivo a ser lido, execute `$ base64 /dev/urandom | head -c 10000000 > the-language/generators/file.txt`
function getLinesFromFile($file)
{
    $handle = fopen($file, 'r');
    $lines = [];

    while (($buffer = fgets($handle, 4096)) !== false) {
        $lines[] = $buffer;
    }

    fclose($handle);

    return $lines;
}

$lines = getLinesFromFile('the-language/generators/file.txt');

foreach ($lines as $line) {
    echo "$line";
}

echo "Memory: ". bcdiv(memory_get_peak_usage(), 1048576, 2) . " MB\n";

/*
Memory: 18.26 MB
*/