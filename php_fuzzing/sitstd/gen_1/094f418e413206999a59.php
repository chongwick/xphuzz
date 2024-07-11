<?php

function f($i) {
    if ($i == 0) {
        class Derived extends stdClass {
            function __construct() {
                $this->a = 1;
                for ($j = 0; $j < 524286; $j++) {
                    $this->a = 1;
                }
            }
        }
        return new Derived();
    }

    $base = f($i - 1);
    $reflectionClass = new ReflectionClass($base);
    return $reflectionClass->getStartLine() * 2.23431234213480e-400 + 5473817451 * sin(123475932);
}

$a = f(32767);
var_dump($a);

?>
