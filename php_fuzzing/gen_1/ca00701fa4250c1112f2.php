<?php
require "/home/w023dtc/template.inc";


function f(&$v, $i) {
  $v[$i] = 0;
  $v[$i + 1] = 0.1;
  $v[$i] = array();
}

$v = array();
push_a_lot($v);
f($v, PHP_INT_MAX);
f($v, PHP_INT_MIN);
f($v, PHP_FLOAT_MAX);
f($v, PHP_FLOAT_MIN);

echo '<pre>'. print_r($v, true). '</pre>';

function push_a_lot(&$arr) {
    for ($i = 0; $i < 20000; $i++) {
        $arr[] = $i;
    }
    return $arr;
}

push_a_lot($v);

echo '<pre>'. print_r($v, true). '</pre>';

?>
