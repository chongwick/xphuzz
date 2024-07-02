<?php
ini_set('memory_limit', '512M'); // adjust the value as per your needs
$r2 = '/(?=)*)/s';
$s0 = str_repeat('a', 220000700); // the size could be different
$result = preg_match_all($r2, $s0, $matches);

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

print_r($matches);

?>
