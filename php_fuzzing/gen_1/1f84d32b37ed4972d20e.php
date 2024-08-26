<?php
require "/home/w023dtc/template.inc";

$v0 = array("foo1" => array("foo2" => array("foo3" => array("foo4" => array("foo5" => array("foo6" => array("foo7" => array())))))));
$v2 = get_class_vars(get_class(new stdClass()));
$v2['__proto__'] = $v0;

$arr1 = array(0, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, array(), array(), array());
$arr2 = array(0, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, array(), array(), array());
$arr3 = array(0, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, array(), array(), array());

$arr1[1] = 0;
$arr2[1] = 0;
$arr3[1] = 0;

$arr1[2] = 0;
$arr2[2] = 0;
$arr3[2] = 0;

$arr1[3] = 0;
$arr2[3] = 0;
$arr3[3] = 0;

$arr1[4] = 0;
$arr2[4] = 0;
$arr3[4] = 0;

$arr1['f'] = 'foo';
$arr1[0] = 4.2;

$arr2['f'] = 'foo';

$arr3['f'] = 'foo';
$arr3[0] = 4.2;
$arr3['f'] = 'f';

function f(array &$a) {
    $a[1] = 0;
}

function foo() {}

f($arr1);
f($arr2);
f($arr3);
f($arr3);

?>
