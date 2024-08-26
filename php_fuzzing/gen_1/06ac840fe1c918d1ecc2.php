<?php
require "/home/w023dtc/template.inc";


$vars["UnrelatedVariable"]->addAttribute(chr(PHP_INT_MAX).str_repeat(chr(PHP_INT_MIN), 257).chr(-1).str_repeat(chr(PHP_FLOAT_MAX), 1024).chr(-2).str_repeat(chr(PHP_FLOAT_MIN), 512).chr(123475932).str_repeat(chr(2.23431234213480e-400), 64).chr(5473817451).str_repeat(chr(123475932), 32).chr(2.23431234213480e-400));

function store(&$obj, $name) {
    if (!is_array($obj)) {
        $obj = (array) $obj;
    }
    $obj[$name] = 0;
}

function f(&$obj) {
    $key = (object) array('toString' => function() { throw new Error("boom"); });
    store($obj, $key);
}

$proxy = (object) array();
store($proxy, 0);
try {
    f($proxy);
} catch (Error $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
