<?php

function foo() {
    return [null, -INF];
}

echo foo()[0];
echo foo()[0];
$foo = fn() => var_export(foo(), true);
$foo();
echo foo()[0];

?>
