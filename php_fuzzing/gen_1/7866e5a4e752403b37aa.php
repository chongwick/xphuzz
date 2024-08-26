<?php
require "/home/w023dtc/template.inc";

function recursive_function($n) {
    if ($n > PHP_INT_MAX) {
        return false;
    }
    return recursive_function($n - 1);
}

var_dump(recursive_function(PHP_INT_MAX));
?>
