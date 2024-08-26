<?php
require "/home/w023dtc/template.inc";


function foo() {
    return array_map(function($x) {
        return null;
    }, array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN));
}

foo();
foo();
foo();
foo();

function bar($b) {
    return array_map(function($x) use ($b) {
        return $b? PHP_INT_MAX : "string";
    }, array());
}

bar(true);
bar(false);
bar(true);
bar(false);
bar(true);

?>
