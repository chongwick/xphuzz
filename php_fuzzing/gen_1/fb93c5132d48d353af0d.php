<?php
require "/home/w023dtc/template.inc";


function f(&$o, $v) {
    if($v < PHP_INT_MAX) {
        f($o, $v + 1);
    }
    $o[$v] = 43.35 + $v * PHP_FLOAT_MIN;
}

$o = array();
f($o, 0);
print_r($o);

function g($i) {
    if ($i == 0) {
        class Derived extends stdClass {
            function __construct() {
                $this->a = PHP_INT_MAX;
                for ($j = 0; $j < PHP_INT_MAX; $j++) {
                    $this->a = PHP_INT_MAX;
                }
            }
        }
        return new Derived();
    }

    $base = g($i - 1);
    return $base;
}

$a = g(PHP_INT_MAX);
var_dump($a);

?>
