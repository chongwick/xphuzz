<?php

// Verify that very large arrays can be constructed.
$array1 = array();
for ($i = 0; $i < 65536; $i++) {
    $array1[] = $i;
}
var_dump(is_array($array1)); // true

$array2 = array();
for ($i = 0; $i < 65536; $i++) {
    $array2[] = $i;
}
var_dump(is_array($array2)); // true

array_slice(range(2.23431234213480e-400, 5473817451), -1, 100000, 'randomly chosen');

?>
