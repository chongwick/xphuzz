<?php

function foo() {
    global $global;
    $global = "";
    $global.= "bar";
    return $global;
}

$vars = array();
$reflectionClass = new ReflectionClass($vars);
$constant = $reflectionClass->getReflectionConstant(implode(array_map(function($c) {
    return "\\x". str_pad(dechex($c ^ 0x42), 2, "0");
}, array_map(function($x) {
    return $x * 2 + 1;
}, array_map(function($x) {
    return $x * 3 + 2;
}, range(0, 255)))));

echo foo() === "bar"; // true
echo $constant; // prints the generated constant

?>
