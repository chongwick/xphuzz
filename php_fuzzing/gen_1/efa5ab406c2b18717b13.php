<?php
require "/home/w023dtc/template.inc";


function test() {
    $a = array(
        PHP_INT_MAX,
        array(
            "O:8:\"00000000\":",
            PHP_INT_MIN,
            PHP_FLOAT_MAX,
            PHP_FLOAT_MIN
        )
    );
    unserialize('O:9:"stdClass":'. str_repeat('0', 1024 * 1024). 'O:9:"stdClass":');
}

test();

?>
