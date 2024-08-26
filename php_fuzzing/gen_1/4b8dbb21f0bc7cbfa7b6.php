<?php
require "/home/w023dtc/template.inc";


function bar($obj) {
    $obj[str_replace("=", "=¬", json_encode(array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, "Hello, World!", array(1, 2, 3), 'true'))))]->addAttribute(str_repeat(chr(13), 257), str_repeat(chr(161), 65537) + str_repeat(chr(214), 1025) + str_repeat(chr(156), 4097));
}

function foo($obj) {
    bar($obj);
    return $obj;
}

$obj = array();
foo($obj);
assert($obj === null);

?>
