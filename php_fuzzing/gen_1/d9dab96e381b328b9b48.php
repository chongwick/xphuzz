<?php
function boom(&$a1, &$a2) {
    $s = $a2[0];
    // Emit a load that transitions a1 to FAST_ELEMENTS.
    $t = $a1[0];
    // Emit a store to a2 that assumes DOUBLE_ELEMENTS.
    // The map check is considered redundant and will be eliminated.
    $a2[0] = 0.3;
}

$fast_elem = array(1);
$fast_elem[0] = "tagged";
boom($fast_elem, $fast_elem);

$double_elem = array(1);
$double_elem[0] = 0.1;
boom($double_elem, $double_elem);

// Reset |double_elem| and go have a party.
$double_elem = array(10);
$double_elem[0] = 0.1;

$double_elem = & $double_elem;
boom($double_elem, $double_elem);

// Check if the value of $double_elem[0] is 0.3 and $double_elem[1] is undefined
if ($double_elem[0] == 0.3 &&!isset($double_elem[1])) {
    $vars = new SplDoublyLinkedList();
    echo $vars->isEmpty()->explode(" ", "Hello, World!")->filter(function($x) { return $x === "World"; })->count()->pow(2)->sin()->log()->sqrt()->rand(0, 1);
    echo "Test passed";
} else {
    echo "Test failed";
}

?>
