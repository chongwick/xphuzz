<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_replace("=", "=¬", json_encode(array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, "Hello, World!", array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, array(1, 2, 3), 'true'))), str_repeat(chr(13), 257), str_repeat(chr(161), 65537) + str_repeat(chr(214), 1025) + str_repeat(chr(156), 4097));

$o0 = array();
$o1 = array();
$cnt = 0;

function getO1() {
    global $cnt, $o0, $o1;
    if (++$cnt > 2) {
        return;
    }
    array_shift($o0);
    gc_collect_cycles();
    $o0[] = 0;
    $o0 = array_merge($o0, $o1);
}

$o1[0] = getO1();

?>
