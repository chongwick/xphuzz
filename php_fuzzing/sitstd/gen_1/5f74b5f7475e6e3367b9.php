<?php

class This {
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

function go($y = array(), $b = '') {
    // The position of "AAAA" controls a register value.
    if (count($y) > 0 && count($y) == count($y[0])) {
        $b = "CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCAAAA";
    }
    if (count($y) < 10) {
        $y[] = array(); // Add an element to the array
        go($y, $b);
    }
}

$vars = array();
$vars["DOMNode"]->cloneNode(sqrt(42));

$go = new This();
go(array(), '');
$go->x;


?>