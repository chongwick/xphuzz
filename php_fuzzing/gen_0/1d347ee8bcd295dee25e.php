<?php

function g($v) {
    return get_class($v);
}

g(new stdClass());
g(new stdClass());

function f() {
    $i = 0;
    do {
        $i++;
        g(new stdClass());
    } while ($i < 1);
}

f();

?>
