<?php
require "/home/w023dtc/template.inc";


class B {
    public $a = PHP_INT_MAX;
    public $b = PHP_INT_MIN;
    public $c = PHP_FLOAT_MAX;
    public $d = PHP_FLOAT_MIN;
}

$b = new B();

echo (string) serialize($b);

?>
