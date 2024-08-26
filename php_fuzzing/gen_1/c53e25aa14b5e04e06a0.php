<?php
require "/home/w023dtc/template.inc";


function test() {
    $array = array_fill(0, PHP_INT_MAX, null);
    $object = (object) array_fill_keys(range(0, PHP_INT_MAX), PHP_FLOAT_MIN);
    $merged_array = array_merge_recursive($array, (array)$object);
    // Deoptimizing is not possible in PHP, but you can use this as a placeholder
    // echo "Deoptimized";
}

test();

?>
