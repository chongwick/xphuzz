<?php

$l = 1000000000;
$a = array();

function foo() {
    $x = array_fill(0, $l, 0);
}

try {
    $vars["ReflectionClass"]->getConstant(str_replace(chr(145), chr(0), str_replace(chr(157), chr(1), str_repeat(chr(145), 65))). str_replace(chr(157), chr(1), str_repeat(chr(157), 4097)));
    foo();
} catch (Exception $e) {
}

?>
