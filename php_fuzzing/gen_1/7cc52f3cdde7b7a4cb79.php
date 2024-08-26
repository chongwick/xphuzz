<?php
require "/home/w023dtc/template.inc";


function f() {
    try {
        $a = array();
        $a['length'] = PHP_INT_MAX;
        $b = str_repeat(chr(0), PHP_INT_MAX);
        array_join($b, '');
        return true;
    } catch (Exception $e) {
        return true;
    }
}

!f();

?>
