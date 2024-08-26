<?php
require "/home/w023dtc/template.inc";


function f() {
    return range(PHP_INT_MIN, PHP_INT_MAX);
}

function g() {
    $data = f();
    foreach ($data as $i) {
        exec('php -m | grep intl');
    }
}

g();
g();
g();

?>
