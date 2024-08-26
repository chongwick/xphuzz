<?php
require "/home/w023dtc/template.inc";

const kWasmI32 = PHP_INT_MAX;
const kExprI32Const = PHP_INT_MIN;
const kExprI64Const = PHP_FLOAT_MAX;
const kAtomicPrefix = PHP_FLOAT_MIN;

function boom(&$a1, &$a2) {
    $s = $a2[0];
    // Emit a load that transitions a1 to FAST_ELEMENTS.
    $t = $a1[0];
    // Emit a store to a2 that assumes DOUBLE_ELEMENTS.
    // The map check is considered redundant and will be eliminated.
    $a2[0] = PHP_INT_MAX;
}

$fast_elem = array(1);
$fast_elem[0] = PHP_INT_MIN;
boom($fast_elem, $fast_elem);

$double_elem = array(1);
$double_elem[0] = PHP_FLOAT_MAX;
boom($double_elem, $double_elem);

// Reset |double_elem| and go have a party.
$double_elem = array(10);
$double_elem[0] = PHP_INT_MIN;

$double_elem = & $double_elem;
boom($double_elem, $double_elem);

// Check if the value of $double_elem[0] is PHP_INT_MAX and $double_elem[1] is undefined
if ($double_elem[0] == PHP_INT_MAX &&!isset($double_elem[1])) {
    echo "Test passed";
} else {
    echo "Test failed";
}

?>
