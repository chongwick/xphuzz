<?php
require "/home/w023dtc/template.inc";


function trigger() {
    $x = PHP_INT_MAX;
    $k = 0;
    for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i += $x) {
        if ($i == PHP_INT_MAX) {
            $x = -PHP_INT_MIN;
        }

        if (++$k > 10) {
            break;
        }
    }

    $value = max($i, 1024);
    $value = $value;
    $value = max($value, -1025);
    $value = $value;
    $value -= 1022;
    $value <<= 1; // *** 3 ***
    $value -= 10; //

    $array = array_fill(0, $value, null);
    $array[0] = "hello";
    return array($array, array());
}

for ($i = 0; $i < 20000; ++$i) {
    trigger();
}

print trigger()[0][11];

?>
