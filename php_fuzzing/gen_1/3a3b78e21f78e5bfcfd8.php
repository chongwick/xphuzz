<?php
require "/home/w023dtc/template.inc";


function __f_4622(array &$a) {
    $a[bytes()] = 1;
    return $a[bytes()];
}

$a = [];
echo __f_4622($a). "\n"; // Output: 1
$a = [];
$a[PHP_INT_MAX] = new \ArrayObject();
echo __f_4622($a). "\n"; // Output: 1
echo __f_4622($a). "\n"; // Output: Notice: Undefined index:  in - on line

?>
