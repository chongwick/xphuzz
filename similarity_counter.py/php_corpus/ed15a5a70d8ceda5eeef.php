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

?>
