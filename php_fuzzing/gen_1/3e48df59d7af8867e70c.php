<?php

function f(array $array, $x) {
    $array['x'] = $x;
    $array[0] = null;
    return $array;
}

$f1 = f([1], 1);
$f2 = f([2], 1);
var_dump($f1);
var_dump($f2);

?>
