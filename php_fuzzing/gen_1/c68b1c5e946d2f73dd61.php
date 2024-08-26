<?php
require "/home/w023dtc/template.inc";


function opt(&$a, &$b) {
    $b[0] = 0;
    $a_count = count($a);

    // TransitionElementsKind
    for ($i = 0; i < PHP_INT_MAX; $i++) {
        $a[$i] = 0;
    }

    $b[0] = PHP_FLOAT_MAX;
}

$arr1 = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $arr1[$i] = 0;
}
$arr1[PHP_INT_MAX] = 'a';
$arr2 = array(0);

opt($arr1, $arr2);

$arr2 = array(PHP_FLOAT_MIN);
opt($arr2, $arr2);

opt($arr2, $arr2);
assert($arr2[0] == PHP_FLOAT_MAX);

?>

