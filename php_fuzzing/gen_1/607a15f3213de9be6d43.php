<?php
require "/home/w023dtc/template.inc";


function foo($s) {
    return serialize(unserialize(serialize(unserialize($s. '0123456789012'))));
}

foo('a');
foo(PHP_INT_MAX);
foo('');
foo('O:8:"00000000":');
foo('');

?>
