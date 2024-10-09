<?php

function foo() {
    for ($a = 0; $a < 2; $a++) {
        if ($a === 1) {
            // There is no direct equivalent of %OptimizeOsr() in PHP
        }
        while (0 && 1) {
            for ($j = 1; $j < 2; $j++) {
                // This loop does nothing and can be removed
            }
        }
    }
}

foo();

?>
