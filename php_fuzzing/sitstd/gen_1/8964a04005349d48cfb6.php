<?php

function f() {
    $g = function($arg = null) {
        if ($arg === null) {
            return 42;
        }
        return $arg;
    };
    return $g;
}

$a = new stdClass();
$b = new stdClass();

$eval = function() {
    eval('echo "Hello, World!";');
};

$x = f();
$y = f();

echo $x(); // Outputs: 42
echo $y(); // Outputs: 42

$eval();

?>
