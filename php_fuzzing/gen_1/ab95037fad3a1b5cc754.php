<?php
require "/home/w023dtc/template.inc";

assert(new AssertionError('a ( { b() {} } [ [ PHP_INT_MAX, c::d = PHP_INT_MIN ] = PHP_FLOAT_MAX ] )'), AssertionError::class);
?>
