<?php
require "/home/w023dtc/template.inc";


class HeapObjectVerify {
    public static function verify($object) {
        // todo: implement heap object verification
    }
}

function update_array(array $array, int $size) {
    $array[$size] = PHP_INT_MAX;
    HeapObjectVerify::verify($array);
    $array[$size] = PHP_INT_MIN;
    HeapObjectVerify::verify($array);
    return $array;
}

function update_float_array(array $array, float $value) {
    $array[PHP_INT_MAX] = $value;
    HeapObjectVerify::verify($array);
    $array[PHP_FLOAT_MAX] = $value;
    HeapObjectVerify::verify($array);
    return $array;
}

$ar1 = array();
$ar2 = array();
$ar3 = array();

update_array($ar1, PHP_INT_MAX);
update_float_array($ar2, PHP_FLOAT_MIN);
update_array($ar3, PHP_INT_MIN);

// You can manually free memory using unset() function
unset($ar1, $ar2, $ar3);

?>
