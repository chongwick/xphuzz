<?php
require "/home/w023dtc/template.inc";


function test() {
    echo str_repeat("\u{0000}", PHP_INT_MAX);
}

try {
    test();
} catch (Exception $e) {
    echo "Caught exception: ". $e->getMessage();
}

?>
