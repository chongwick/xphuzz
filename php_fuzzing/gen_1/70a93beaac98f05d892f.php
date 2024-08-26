<?php
require "/home/w023dtc/template.inc";


function serialize_and_deserialize() {
    $var1 = array_fill(0, PHP_INT_MAX, 'x');
    $var2 = array_fill(0, PHP_INT_MAX, 0);
    $var3 = array_merge_recursive($var1, $var2);
    $var4 = serialize($var3);
    unserialize($var4);
}

serialize_and_deserialize();

?>
