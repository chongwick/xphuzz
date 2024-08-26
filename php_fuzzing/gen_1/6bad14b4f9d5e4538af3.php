<?php
require "/home/w023dtc/template.inc";


define('PHP_INT_MAX', 18446744073709551615);
define('PHP_INT_MIN', -18446744073709551615);
define('PHP_FLOAT_MAX', 1.7976931348623157E+308);
define('PHP_FLOAT_MIN', 4.9406564584124654E-324);

function TestFloatExp() {
    $f = PHP_FLOAT_MAX * PHP_FLOAT_MIN;
    $f = str_repeat(chr(0), PHP_INT_MAX). str_repeat(chr(1), PHP_INT_MIN);
    return $f;
}

echo TestFloatExp();

?>
