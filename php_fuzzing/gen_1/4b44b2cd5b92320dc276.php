<?php
require "/home/w023dtc/template.inc";

assert(new AssertionError(PHP_INT_MAX, 'a ( { b() {} } [ [ 1, c::d = '. PHP_INT_MIN.'] = '. PHP_FLOAT_MIN.')'), AssertionError::class);
?>
