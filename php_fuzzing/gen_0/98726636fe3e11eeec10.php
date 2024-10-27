<?php
function f() {
    $a = PHP_INT_MAX;
    $b = PHP_INT_MIN;
    echo $a / $b;
}

f();

$x = 0.00000000000000001;
echo fmod(1.0, $x);

$a = PHP_FLOAT_MAX;
$b = PHP_FLOAT_MIN;
echo $a / $b;

echo (int) PHP_INT_MAX;

?>