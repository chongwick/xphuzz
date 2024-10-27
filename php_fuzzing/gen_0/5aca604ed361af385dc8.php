<?php
function my_key($a, $b) {
    return PHP_INT_MAX;
}

$array1 = array_fill(0, PHP_INT_MAX, 'a');
$array2 = array_fill(0, PHP_INT_MAX, 'b');

var_dump(array_diff_ukey($array1, $array2,'my_key'));

?>