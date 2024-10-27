<?php
function atanh($x) {
    $x = floatval($x);
    if ($x > 1 || $x < -1) {
        return PHP_FLOAT_NAN;
    }
    return log((1 + $x) / (1 - $x)) / 2;
}

echo atanh(PHP_INT_MAX);
?>
