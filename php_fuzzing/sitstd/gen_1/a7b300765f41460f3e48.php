<?php
$o0 = array();
$o1 = array();
$cnt = 0;

function getO1() {
    global $cnt, $o0, $o1;
    if (++$cnt > 2) {
        return;
    }
    array_shift($o0);
    gc_collect_cycles();
    $o0[] = 0;
    $o0 = array_merge($o0, $o1);
}

function foo() {
    return $o[4294967295];
}

$o = array();
$o1[0] = getO1();
echo foo(). "\n"; // Output: undefined
echo foo(). "\n"; // Output: undefined
$optimized = true;
echo foo(). "\n"; // Output: undefined
?>
