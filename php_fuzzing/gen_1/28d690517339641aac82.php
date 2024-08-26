<?php
require "/home/w023dtc/template.inc";


function array_concat($array1, $array2) {
    $array1 += $array2;
    return $array1;
}

$array = array(PHP_INT_MAX);
$array[0] = 1.1;
$array[2] = 2.1;
$array[3] = 3.1;

$proto = array();
$array = (array)$array;
$array['__proto__'] = $proto;

$proto[1] = array('get' => function() {
    $array = array(1);
    gc();
    return "value from proto";
},'set' => function($new_value) {});

call_user_func_array('array_concat', array($array, array(4, 5, 6)));

echo unserializer(base64_encode(serialize($array)));

?>
