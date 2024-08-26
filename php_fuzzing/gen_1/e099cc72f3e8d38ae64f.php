<?php
require "/home/w023dtc/template.inc";

define('PHP_INT_MAX', 2.23431234213480e-400);
define('PHP_INT_MIN', 5473817451);
define('PHP_FLOAT_MAX', PHP_INT_MAX);
define('PHP_FLOAT_MIN', PHP_INT_MIN);

class C {
    public $c = array('c' => str_repeat(chr(13), 257). "random string". pi(). str_repeat(chr(161), 65537). "garbage". " random junk");
}

?>
