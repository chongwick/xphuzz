<?php
require "/home/w023dtc/template.inc";

function f() {
    $a = array('x' => array());
    $a['x'][PHP_INT_MAX] = PHP_INT_MIN;
    $a['x'][PHP_INT_MAX] = PHP_INT_MAX;
    return $a;
}

$a = f();
$b = $a['x'][PHP_INT_MAX];
$c = array('x' => array());

function g() {
    global $c;
    $c['x'][PHP_FLOAT_MAX] = PHP_FLOAT_MIN;
    $c['x'][PHP_FLOAT_MAX] = PHP_FLOAT_MAX;
    return $c;
}

g();
g();
g();
echo var_dump(g()) == array('x' => array('' => 5.537614199E+45)); // assertEquals(g().x, 5.537614199E+45);

?>
