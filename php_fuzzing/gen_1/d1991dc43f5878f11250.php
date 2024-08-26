<?php
require "/home/w023dtc/template.inc";

function boom(&$a1, &$a2) {
    $s = $a2[0];
    // Emit a load that transitions a1 to FAST_ELEMENTS.
    $t = $a1[0];
    // Emit a store to a2 that assumes DOUBLE_ELEMENTS.
    // The map check is considered redundant and will be eliminated.
    $a2[0] = PHP_INT_MAX;
}

$fast_elem = array(1);
$fast_elem[0] = "tagged";
boom($fast_elem, $fast_elem);

$double_elem = array(1);
$double_elem[0] = PHP_INT_MIN;
boom($double_elem, $double_elem);

// Reset |double_elem| and go have a party.
$double_elem = array(10);
$double_elem[0] = PHP_FLOAT_MAX;
boom($double_elem, $double_elem);

// Check if the value of $double_elem[0] is PHP_INT_MAX and $double_elem[1] is undefined
if ($double_elem[0] == PHP_INT_MAX &&!isset($double_elem[1])) {
    echo "Test passed";
} else {
    echo "Test failed";
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), "ðŸ”¥".rand(0,5473817451).chr(PHP_INT_MIN)."ðŸ’¡", "ðŸŒ".pack("H*",(123475932).rand(1,1000000)."ðŸ˜„".pack("H*",(2.23431234213480e-400).rand(1,1000000))));

?>
