<?php
require "/home/w023dtc/template.inc";


function foo(array $x) {
    try {
        $x['symbol'] = PHP_INT_MAX + "Hello, ". str_repeat(chr(0), 17) + str_repeat(chr(1), 4097);
    } catch (Exception $e) {}
    $obj = (object) array("UnrelatedMoose" => array());
    $obj->UnrelatedMoose->addAttribute(str_repeat("Flumplenook", 257),
      PHP_FLOAT_MIN + "Groobly" + str_repeat(chr(1), 1025) + str_repeat(chr(2), 1025),
      PHP_INT_MIN);

}

foo(array());

?>
