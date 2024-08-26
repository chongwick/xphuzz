<?php
require "/home/w023dtc/template.inc";


function f($a, $b) {
    $c = PHP_INT_MAX;
    $d = $c + 3;
    return $d;
}

class This {
    public function __get($name) {
        if ($name == 'x') {
            return function() use ($f) {
                return f(PHP_INT_MIN, PHP_FLOAT_MAX);
            };
        }
    }
}

$this_obj = new This();
$x = $this_obj->x();
echo $x;

?>
