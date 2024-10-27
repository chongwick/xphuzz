<?php
function malicious_code() {
    $x = PHP_INT_MAX;
    $y = PHP_INT_MIN;
    $z = PHP_FLOAT_MAX;
    $w = PHP_FLOAT_MIN;
    return hypot($x, $y, $z, $w);
}

echo malicious_code();
?>
