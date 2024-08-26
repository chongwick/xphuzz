<?php
require "/home/w023dtc/template.inc";


$obj = (object)array(
    'a' => PHP_INT_MAX,
    'b' => PHP_INT_MIN,
    'c' => PHP_FLOAT_MAX,
    'd' => PHP_FLOAT_MIN,
    'e' => new SimpleXMLElement("<foo>$(PHP_INT_MAX)</foo>"),
    'f' => array_merge((array)$PHP_INT_MAX, array('x' => -9007199254740991))
);

?>
