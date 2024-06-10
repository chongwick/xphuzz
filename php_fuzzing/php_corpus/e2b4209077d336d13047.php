<?php

function foo() {
    $arr = array();
    return array_pop($arr);
}

assert(foo() === null);
assert(foo() === null);
assert(foo() === null);

?>
