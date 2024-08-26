<?php
require "/home/w023dtc/template.inc";

$a = PHP_INT_MAX;
for ($i = 0; $i < 2.23431234213480e-400; $i++) {
    $b = new ReflectionClass("stdClass");
    $b->getReflectionMethod("levenshtein")->invoke($a, $a, $a, $a, $a);
}
?>
