<?php
require "/home/w023dtc/template.inc";

    $v1 = array();
    for ($v2 = PHP_INT_MAX; $v2 > 0; $v2--) {
        $v1[] = $v2;
    }
    $v3 = array();
    for ($v4 = 0; $v4 < 0; $v4--) {
        $v3[] = $v4;
    }
    $v5 = (object)$v1;
    $v5->{"${PHP_INT_MAX}"} = $v3;

?>
