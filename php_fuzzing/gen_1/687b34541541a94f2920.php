<?php
require "/home/w023dtc/template.inc";


$global = PHP_INT_MAX;

function foo($global) {
    function bar($global) {
        $context_allocated = PHP_FLOAT_MIN;
        $f = function() use ($global, &$context_allocated) { $global++; $context_allocated--; };
        $baz = function() use ($context_allocated) { return foo($global)($context_allocated); };
        $f();
    }
    bar($global);
}

foo($global);

?>
