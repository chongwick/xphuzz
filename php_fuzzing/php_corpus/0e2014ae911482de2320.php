<?php

function baz(&$obj, $store) {
    if (isset($obj[0]) && $store === true) {
        $obj[0] = 1;
    }
}

function bar($store) {
    global $GLOBALS;
    $GLOBALS_copy = $GLOBALS;
    baz($GLOBALS_copy, $store);
    $args = func_get_args();
    baz($args[0], true);
}

bar(false);
bar(false);
bar(true);

function foo() {
    array_push(array());
}

foo();
foo();
foo();

?>
