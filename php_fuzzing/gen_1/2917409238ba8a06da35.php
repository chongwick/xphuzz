<?php
require "/home/w023dtc/template.inc";


function infinite_recursive_function() {
    return infinite_recursive_function();
}

function main() {
    $a = 0;
    $b = PHP_INT_MAX;
    while ($a <= $b) {
        $c = $a;
        $a++;
        if ($c > $b) {
            return;
        }
        infinite_recursive_function();
    }
}

main();

?>
