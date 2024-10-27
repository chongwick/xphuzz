<?php
function crash() {
    $a = array_fill(0, PHP_INT_MAX, 0);
    $b = array_fill(0, PHP_INT_MIN, 0);
    $c = array_merge($a, $b);
    return $c;
}

crash();

?>