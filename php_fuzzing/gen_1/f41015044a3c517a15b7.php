<?php
require "/home/w023dtc/template.inc";


$array = array();
$funky = (object)array('value' => 'funky');
for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    $array[$i] = $i;
}
$array[PHP_INT_MAX] = $funky;
echo json_encode($array) == '[{"value":"funky"},2147483647,2147483648,...,9223372036854775807]'? 'true' : 'false';

function foo() {
    $a = array(0 => PHP_FLOAT_MAX, 1 => PHP_FLOAT_MIN);
    return $a[2];
}

foo();
foo();
foo();

?>

