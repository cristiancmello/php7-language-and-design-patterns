<?php

declare(ticks=1);

$instCount = 0;

function tick_handler() {
    global $instCount;
    $instCount++;
}

$array = [1, 2, 3, 4, 5, 6, 7, 9];

register_tick_function('tick_handler');

// O(n) search
function linear_search($array, $elem) {
    for ($i = 0, $total = count($array); $i < $total; $i++) {
        null; // NOP
        if ($array[$i] == $elem) return $i;
    }
    return -1;
}

$result = linear_search($array, 2);
echo "ops = $instCount\n";


// Best case
$instCount = 0;
$result = linear_search($array, 1);
$bestCaseCount = $instCount;

// Worst case
$instCount = 0;
$result = linear_search($array, 9);
$worstCaseCount = $instCount;

echo "Best Case: $bestCaseCount ops\n";
echo "Worst Case: $worstCaseCount ops\n";

echo "Case 1: $bestCaseCount ops \n";

$instCount = 0;
$result = linear_search($array, 2);
$case_2 = $instCount;
echo "Case 2: $case_2 ops\n";

$instCount = 0;
$result = linear_search($array, 3);
$case_3 = $instCount;
echo "Case 3: $case_3 ops\n";

$rel_1 = ($case_2 - $bestCaseCount);
$rel_2 = ($case_3 - $case_2);

echo "relation 1: $rel_1 ops\nrelation 2: $rel_2 ops\n";

echo ($rel_1 == $rel_2? "linear_search is O(n) or linear" : "linear_search is not linear") . "\n";
