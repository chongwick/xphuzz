<?php

const magic0 = 2396;
const magic1 = 1972;

// Fill xs with float arrays.
$xs = [];
for ($j = 0; $j < magic0; ++$j) {
    $xs[] = [$j + 0.1];
}

// Sort, but trim the array at some point.
$cmp_calls = 0;
usort($xs, function($lhs, $rhs) {
    $lhs = $lhs? $lhs : [0];
    $rhs = $rhs? $rhs : [0];
    if (++$cmp_calls == magic1) {
        $xs = array_slice($xs, 0, 1);
    }
    return $lhs[0] - $rhs[0];
});

// The final shape of the array is unspecified since the comparison function is
// inconsistent.

?>
