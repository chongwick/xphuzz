<?php
require "/home/w023dtc/template.inc";


class MyRegExp {
    function __construct($pattern, $flags = '') {
        $this->pattern = $pattern;
        $this->flags = $flags;
        $this->size = PHP_INT_MAX;
    }

    function exec($str) {
        $this->matches = array_fill(0, PHP_INT_MAX, ['x' => PHP_FLOAT_MAX]);
        return $this->matches;
    }
}

class Module {
    function f() {
        $myregexp = new MyRegExp('/./', 'i');
        $matches = $myregexp->exec("a");
        echo $matches[PHP_INT_MIN]['x'];
    }
}

Module::f();

?>
