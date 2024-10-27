<?php
function test() {
    $a = array('a' => PHP_INT_MAX, 'b' => PHP_INT_MIN, 'c' => PHP_FLOAT_MAX, 'd' => PHP_FLOAT_MIN);
    $b = array('a' => PHP_INT_MAX, 'b' => PHP_INT_MIN, 'c' => PHP_FLOAT_MAX, 'd' => PHP_FLOAT_MIN);
    return array_uintersect_assoc($a, $b,'strcmp');
}

echo serialize(test());
?>
