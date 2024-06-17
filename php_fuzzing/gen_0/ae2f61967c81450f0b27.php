<?php

function foo($x) {
    $mem = array_fill(0, 1, 0);
    $mem[$x % 1] *= 0;
    return $mem;
}

foo(-926416896 * 8 * 1024);

?>
