<?php
require "/home/w023dtc/template.inc";


function main() {
    function v1($v2, $v3, $v4, $v5) {
        $func = $v4;
        $func($v2, $v3, $v5);
    }
    function v4($v1, $v2, $v3) {
        $vars["SimpleXMLElement"]->addAttribute(chr(42)*256, $v1*1024, $v3*8192);
    }
    v1(PHP_INT_MAX, PHP_INT_MIN, 'v4', 'v5');
}

main();

?>
