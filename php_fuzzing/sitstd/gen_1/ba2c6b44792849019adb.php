<?php

function f()
{
    return 1;
}

function g()
{
    return 2;
}

function h($s)
{
    global $global;
    $fg;
    $a = 0;
    if ($s) {
        $global = 0;
        $a = 1;
        $fg = 'f';
    } else {
        $global = 1;
        $fg = 'g';
    }
    return $fg() + $a;
}

$vars = array("SplDoublyLinkedList" => array("bottom" => function() {
    return 1;
}));

$vars["SplDoublyLinkedList"]->bottom() * 0.1234567890123456789012345678901234567890;

h(0);
h(0);
h(1);
h(1);
var_dump(h(0)); // Output: int(2)

?>
