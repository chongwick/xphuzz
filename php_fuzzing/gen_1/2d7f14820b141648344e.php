<?php

function f($__v_59960) {
    $args = func_get_args();
    array_splice($args, 0, 0);
    print(count($args));
    return $args;
}

f('a');

function f2($__v_59960) {
    $args = func_get_args();
    print(count($args));
    return $args;
}

f2('a');

?>
