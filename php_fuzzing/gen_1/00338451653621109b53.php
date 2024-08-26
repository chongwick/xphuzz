<?php
require "/home/w023dtc/template.inc";


class C {
}

function f($b) {
    $o = new C();
    if ($b) {
        $o->t = PHP_INT_MAX;
    }
    return $o->t;
}

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    new C();
}

echo f(true). "\n";
echo f(true). "\n";
echo f(false). "\n";

function g($a) {
    $x = array_shift($a);
    return $x;
}

function h() {
    $a = array(PHP_FLOAT_MAX, 2, null, 3);
    $a[0] = PHP_INT_MIN;
    return $a;
}

g(h());
g(h());
g(h());

?>
