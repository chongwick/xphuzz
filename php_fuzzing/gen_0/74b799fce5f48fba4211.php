<?php

function test() {
    $array = array();
    $object = (object) array();
    $merged_array = array_merge_recursive($array, (array)$object);
    // Deoptimizing is not possible in PHP, but you can use this as a placeholder
    // echo "Deoptimized";
}

test();

?>
