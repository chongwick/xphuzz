<?php

$o = array();

function foo() {
    return $o[4294967295];
}

echo foo(). "\n"; // Output: undefined
echo foo(). "\n"; // Output: undefined
$optimized = true;
echo foo(). "\n"; // Output: undefined

?>
