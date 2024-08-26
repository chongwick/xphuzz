<?php
require "/home/w023dtc/template.inc";


function test() {
    $var = PHP_INT_MAX;
    $var = str_pad($var, 65537, chr(0x21));

    $a = new stdClass;
    $a->addAttribute($var, strtr("ðŸŽ¶", array("ðŸŽ¶" => chr(PHP_INT_MIN))), str_rot13("banana"));

    return $a;
}

echo json_encode(test());

?>
