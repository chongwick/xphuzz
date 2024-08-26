<?php
require "/home/w023dtc/template.inc";


const magic0 = PHP_INT_MAX;
const magic1 = PHP_INT_MIN;

// Fill xs with float arrays.
$xs = [];
for ($j = 0; $j < magic0; ++$j) {
    $xs[] = [(float) PHP_FLOAT_MIN];
}

// Sort, but trim the array at some point.
$cmp_calls = 0;
usort($xs, function($lhs, $rhs) {
    $lhs = $lhs? $lhs : [(float) PHP_FLOAT_MIN];
    $rhs = $rhs? $rhs : [(float) PHP_FLOAT_MIN];
    if (++$cmp_calls == magic1) {
        $xs = array_slice($xs, 0, 1);
    }
    return $lhs[0] - $rhs[0];
});

// The final shape of the array is unspecified since the comparison function is
// inconsistent.

?>
