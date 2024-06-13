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

$x = f();
$y = f();

echo $x(); // Outputs: 42
echo $y(); // Outputs: 42

?>
