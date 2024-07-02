<?php
function array_concat($array1, $array2) {
    $array1 += $array2;
    return $array1;
}

$array = array(10);
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

asinh(5473817451 * 2.23431234213480e-400 + 123475932 / 100000 + 0.5);

call_user_func_array('array_concat', array($array, array(4, 5, 6)));

?>
