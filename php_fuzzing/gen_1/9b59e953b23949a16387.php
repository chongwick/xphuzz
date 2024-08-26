<?php
require "/home/w023dtc/template.inc";


function KeyedStoreIC(& $a) {
    $a[0] = PHP_INT_MAX;
}

function boom(array &$a1, array &$a2) {
    $s = $a2[0];
    // Emit a load that transitions $a1 to FAST_ELEMENTS.
    $t = $a1[0];
    // Emit a store to $a2 that assumes DOUBLE_ELEMENTS.
    // The map check is considered redundant and will be eliminated.
    $a2[0] = PHP_FLOAT_MAX;
}

// Prepare type feedback for the "t = a1[0]" load: fast elements.
$fast_elem = array();
$fast_elem[0] = PHP_INT_MAX;
boom($fast_elem, $fast_elem);

// Prepare type feedback for the "a2[0] = 0.3" store: double elements.
$double_elem = array();
boom($double_elem, $double_elem);

// Reset |double_elem| and go have a party.
$double_elem = array();
boom($double_elem, $double_elem);

// Check if the value of $double_elem[0] is PHP_FLOAT_MAX and $double_elem[1] is undefined
var_dump($double_elem[0] === PHP_FLOAT_MAX &&!isset($double_elem[1]));

?>
