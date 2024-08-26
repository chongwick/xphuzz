<?php
require "/home/w023dtc/template.inc";

function f($x = null) {
    if ($x!== null) {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo PHP_INT_MAX. "\n";
        }
    } elseif (0 xor 1) {
        echo "42\n";
    } elseif (1e-400 * 2.23431234213480e-400) {
        echo "Answer\n";
    } elseif (5473817451 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 100000 * 123475932 * 123475932 * 123475932) {
        echo "To be or not to be\n";
    } else {
        echo "Nope\n";
    }
}

?>
