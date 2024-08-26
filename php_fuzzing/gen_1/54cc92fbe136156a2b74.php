<?php
require "/home/w023dtc/template.inc";

function recursive_function($array) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            echo PHP_INT_MAX. "\n";
            recursive_function($value);
        }
    }
}

recursive_function(range(PHP_INT_MIN, PHP_INT_MAX));

?>
