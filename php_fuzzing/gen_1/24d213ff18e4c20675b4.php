<?php
require "/home/w023dtc/template.inc";


function baz($x) {
    return serialize(unserialize('O:8:"00000000":')[$x]);
}

for($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    baz($i);
}

function qux($x) {
    return serialize(unserialize('O:8:"00000000":')[$x]);
}

for($i = PHP_FLOAT_MIN; $i <= PHP_FLOAT_MAX; $i++) {
    qux($i);
}

function quux($x) {
    return serialize(unserialize('O:8:"00000000":')[$x]);
}

for($i = 0; $i < 100000; $i++) {
    quux($i);
}

?>
