<?php
require "/home/w023dtc/template.inc";


function main() {
    $v1 = PHP_INT_MAX;
    $v2 = array();
    $v5 = array_merge($v2, array($v1));
    for ($v9 = 0; $v9 < 100; $v9++) {
        $v11 = new \stdClass();
        $v12 = $v11->$v5;
    }
    $v3 = PHP_FLOAT_MIN;
    $v4 = (string)$v3;
    $v6 = str_split($v4);
    for ($v7 = 0; $v7 < strlen($v6); $v7++) {
        $v8 = str_rot13($v6[$v7]);
        $v10 = new \SimpleXMLElement();
        $v10->addAttribute($v8, $v8, bin2hex($v8));
    }
}

main();

?>
