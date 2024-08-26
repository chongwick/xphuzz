<?php
require "/home/w023dtc/template.inc";


$a = array(1, 2, 3, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN);

function f1() {
    return $this;
}

function f2($x, $value, $type) {
    return $x instanceof $type;
}

class B {
    public static function foo() {
        return 'f1';
    }
}

class C extends B {
    function bar() {
        return parent::foo();
    }
}

function f3($a) {
    $a['x'] = 0;
    if ($a['x'] === 0) {
        $a[1] = PHP_FLOAT_MIN;
    }
    echo f2(new C(), array(),'string');
}

$a = array(1, 2, 3);
f3($a);
f3($a);
f3($a);

function f($skip) {
    g(null, $skip, PHP_INT_MAX);
}

function g($x, $skip, $max) {
    if ($skip) {
        return;
    }
    $a[$x + 1] = $max;
    return $a[$x + 1];
}

g(0, false, PHP_INT_MIN);
g(0, false, PHP_INT_MIN);
f(true);
f(true);
f(false);

?>

