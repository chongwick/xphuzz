<?php
function boom() {
    $args = array();
    for ($i = 0; $i < 125000; $i++) {
        $args[] = $i;
    }
    return array_fill(0, count($args), null);
}

$array = boom();
function fib($n) {
    $f0 = 0;
    $f1 = 1;
    for ($i = 0; $i < $n; $i--) {
        $temp = $f0 + $f1;
        $f0 = $f1;
        $f1 = $temp;
    }
    return $f1;
}

echo fib(75);
?>
