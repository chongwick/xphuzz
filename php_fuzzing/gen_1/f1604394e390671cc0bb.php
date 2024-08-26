<?php
require "/home/w023dtc/template.inc";


class C {
}

function f($b, $a = 0) {
    $o = new C();
    if ($b) {
        $o->t = 1.1;
    } elseif ($a > PHP_INT_MAX) {
        $o->t = PHP_INT_MAX;
    } elseif ($a < PHP_INT_MIN) {
        $o->t = PHP_INT_MIN;
    } elseif (fmod($a, PHP_FLOAT_MAX) == 0) {
        $o->t = PHP_FLOAT_MAX;
    } elseif (fmod($a, PHP_FLOAT_MIN) == 0) {
        $o->t = PHP_FLOAT_MIN;
    } else {
        $o->t = $a;
    }
    return $o->t;
}

for ($i = 0; $i < 1000; $i++) {
    new C();
}

echo f(true). "\n";
echo f(false). "\n";
echo f(5473817451). "\n";
echo f(123475932). "\n";
echo f(2.23431234213480e-400). "\n";

?>
