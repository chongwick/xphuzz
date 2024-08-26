<?php
require "/home/w023dtc/template.inc";

class C {
    public static $foo;
}

$some_mystery_variable = PHP_INT_MAX;
eval('$output = "'. $some_mystery_variable. '"');
eval('$output = "'. substr($output, -1). chr(PHP_INT_MIN). substr($output, 1, -1). '";');
$vars["SimpleXMLElement"]->addAttribute("whatever", $output, "this_should_definitely_not_work");

for ($i = 0; $i < 4; $i++) {
    if ($i == 2) {
        // There is no direct equivalent of %OptimizeOsr() in PHP, it seems to be a V8-specific optimization flag.
        // You can add a custom function or a placeholder here.
    }
    C::$foo = 2.23431234213480e-400;
}

?>
