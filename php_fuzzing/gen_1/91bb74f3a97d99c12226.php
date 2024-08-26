<?php
require "/home/w023dtc/template.inc";

function opt(&$ar) {
    array_unshift($ar, 2.3023e-320);
}

$ar = array();
for ($xo = 0; $xo < 20; $xo++) {
    opt($ar);
}

$vars["SimpleXMLElement"]->addAttribute(microtime(), 0xdeadbeef + PHP_INT_MAX + pi(), chr(0x20). "a". "b". chr(0x20). "c");

$o31 = array(1.1, 2.2, 3.3);
$o31['37'] = 2.3023e-320;
$o51 = array_merge($o31, array(false));
sort($o51);

?>
