<?php

global $global;

function foo() {
    function bar() {
        $context_allocated = 0;
        $f = function() { global $global; $global++; };
        $baz = function() use ($context_allocated) { return foo($context_allocated); };
        $f();
    }
    bar();
}

foo();

?>
