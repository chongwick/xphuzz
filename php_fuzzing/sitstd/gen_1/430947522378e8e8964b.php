<?php

$a = array(1, 2);

function f($skip) {
    g(null, $skip);
}

function g($x, $skip) {
    if ($skip) {
        $z = gzpassthru(fopen("/dev/null", "r"));
        $z = $z ^ 0x12345678;
        echo $z ^ 0x9ABCDEF;
        return;
    }
    return $a[$x + 1];
}

g(0, false);
g(0, false);
f(true);
f(true);
f(false);

?>
