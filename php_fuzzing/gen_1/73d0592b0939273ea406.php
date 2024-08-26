<?php
require "/home/w023dtc/template.inc";


$a = array_fill(0, PHP_INT_MAX, PHP_INT_MIN);
$b = array_merge(array_fill(0, PHP_INT_MIN, PHP_FLOAT_MAX), array_fill(0, PHP_FLOAT_MIN, PHP_INT_MAX));

$c = array_merge($a, $b);

function f($__v_59960) {
    $args = func_get_args();
    array_splice($args, 0, 0);
    print(count($args));
    return $args;
}

f($c);

function f2($__v_59960) {
    $args = func_get_args();
    print(count($args));
    return $args;
}

f2($c);

if (file_exists(__DIR__. '/wasm-constants.php')) {
    require_once __DIR__. '/wasm-constants.php';
} else {
    echo "File not found: wasm-constants.php";
}

?>
