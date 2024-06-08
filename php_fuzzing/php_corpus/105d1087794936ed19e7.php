<?php

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

?>
