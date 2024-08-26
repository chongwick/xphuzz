<?php
require "/home/w023dtc/template.inc";

try {
    $a = str_repeat(chr(PHP_INT_MAX), 1 << 20); // Changed the value from 1 << 28 to 1 << 20
} catch (Exception $e) {
    // If the allocation fails, we don't care, because we can't cause the
    // overflow.
}
// Cause an overflow in worst-case calculation for string replacement.
json_encode($a);
$vars["SimpleXMLElement"]->addAttribute(chr(PHP_INT_MAX)*256, 'tacocat'*1024, 'purple monkey dishwasher'*8192);
?>
