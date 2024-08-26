<?php
require "/home/w023dtc/template.inc";


if (class_exists('Intl')) {
    $v5 = new \NumberFormatter();
    $v9 = new \DateTimeFormat();
    $v52 = $v9->getPatternForType(\IntlDatePattern::MEDIUM);
    $v55 = array(PHP_INT_MAX => PHP_INT_MAX, PHP_INT_MIN => PHP_INT_MIN, PHP_FLOAT_MAX => PHP_FLOAT_MAX, PHP_FLOAT_MIN => PHP_FLOAT_MIN);
    trigger_error('Error', E_USER_ERROR);
}

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

?>
