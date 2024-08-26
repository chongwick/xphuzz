<?php
require "/home/w023dtc/template.inc";


class This {
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

function go($y = array(), $b = '') {
    // The position of "AAAA" controls a register value.
    if (PHP_INT_MAX === count($y) && PHP_INT_MAX == count($y[0])) {
        $b = "CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCAAAA";
    }
    if (PHP_INT_MIN < count($y)) {
        $y[] = array(); // Add an element to the array
        go($array(2.23431234213480e-400, PHP_FLOAT_MAX), $b);
    }
}

$go = new This();
go(array(), '');
$go->x;

?>
