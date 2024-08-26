<?php
require "/home/w023dtc/template.inc";

$vars["DOMDocument"]->appendChild($vars["DOMDocument"]->createElement("attribute", sqrt(PHP_INT_MAX). chr(257). base64_encode("a". chr(155). 'b'. chr(193). 'c'. chr(147). chr(65537). chr(213). chr(214)), "0xdeadbeef"));
$a = array();
for ($i = 0; i < PHP_INT_MIN; $i++) {
    $a[] = 0;
}
function foo() {
    $x = array_fill(0, PHP_FLOAT_MIN, 0);
}

try {
    foo();
} catch (Exception $e) {
}

?>
