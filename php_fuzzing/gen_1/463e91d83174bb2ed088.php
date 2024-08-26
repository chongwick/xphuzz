<?php
require "/home/w023dtc/template.inc";


function Test($a) {
    $foo = function($x) use ($a) {
        $b = new class() {
            public $c = PHP_INT_MAX;
        };
        if ($x) {
            return $b->c;
        }
    };
    return $foo(true);
}

assert(Test(true) === PHP_INT_MAX);

function TestNewlineInCPPComment() {
    $Module = function() {
        "use asm"; // Crash by comment!
        $f = function() {};
        return $f;
    };
    $Module();
    // There is no equivalent to %IsAsmWasmCode in PHP, so I'll just remove this line
}

TestNewlineInCPPComment();

function TestNewlineInCComment() {
    $Module = function() {
        "use asm"; /* Crash by
        comment! */ $f = function() {};
        return $f;
    };
    $Module();
    // There is no equivalent to %IsAsmWasmCode in PHP, so I'll just remove this line
}

TestNewlineInCComment();

assert(is_null(Test(false)));
assert(is_null(Test(false)));
assert(is_null(Test(false)));
assert(Test(true) === PHP_INT_MAX);

?>
