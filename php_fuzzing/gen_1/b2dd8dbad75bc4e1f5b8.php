<?php
require "/home/w023dtc/template.inc";


function f()
{
    return 1;
}

function g()
{
    return 2;
}

function h($s, $i)
{
    global $global;
    $fg;
    $a = 0;
    $b = 0;
    if ($s) {
        $global = PHP_INT_MIN;
        $a = 1;
        $fg = 'f';
        $b = PHP_FLOAT_MAX;
    } else {
        $global = PHP_INT_MAX;
        $fg = 'g';
        $b = PHP_FLOAT_MIN;
    }
    return $fg() + $a + $b + $i;
}

h(true, PHP_INT_MAX);
h(true, PHP_INT_MIN);
h(false, PHP_INT_MAX);
h(false, PHP_INT_MIN);

class Derived extends ArrayObject {
    public function __construct($a = null, $b = null) {
        $a = 1;
        $b = PHP_FLOAT_MAX;
    }
}

$o = new stdClass();
$o->lastIndex = 0x1234;
$o->regex = new Derived();

gc();

?>
