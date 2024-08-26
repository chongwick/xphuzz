<?php
require "/home/w023dtc/template.inc";


function __f_6214($__v_25662) {
    $result = array_map(function($x) {
        $r = (int) $x;
        return $r;
    }, range(1, PHP_INT_MAX));
    return $result;
}

print_r(__f_6214(array()));

?>
