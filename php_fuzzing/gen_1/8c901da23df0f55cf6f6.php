<?php
require "/home/w023dtc/template.inc";


function f(array &$a) {
    $a[1] = 0;
}

function foo() {}

$str = str_repeat(chr(0), 257);
$arr1 = array(
    'SimpleXMLElement' => new SimpleXMLElement('<root/>'),
    'addAttribute' => array(
        'name' => $str,
        'value' => bin2hex(str_repeat(chr(1), 257). str_repeat(chr(-1), 17). str_repeat(chr(2), 4097)),
    ),
    'f' => 'foo',
    '0' => PHP_FLOAT_MAX,
);

$arr2 = array(
    'f' => 'foo',
    '0' => PHP_INT_MAX,
);

$arr3 = array(
    'f' => 'foo',
    '0' => PHP_FLOAT_MIN,
);

f($arr1);
f($arr2);
f($arr3);
f($arr3);

?>
