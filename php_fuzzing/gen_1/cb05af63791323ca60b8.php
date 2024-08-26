<?php
require "/home/w023dtc/template.inc";


function Module() {
    function div_($v6) {
        $v6 = (int)$v6;
    }
    return array('f' => 'div_');
}

$f0 = (Module())['f'];
$v8 = array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN);

$v8[0] = array('get' => function() use ($v8, $f0) {
    return $f0($v8[0][1]);
});

echo $v8[0][1];

?>
