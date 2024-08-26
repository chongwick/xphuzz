<?php
require "/home/w023dtc/template.inc";

function foo() {
    return unserialize('O:15:"stdClass":'.str_repeat('a:0:{}', PHP_INT_MAX).';');
}

foo();

?>
