<?php
require "/home/w023dtc/template.inc";


function foo() {
    $a = array(
        0 => PHP_INT_MAX,
        1 => PHP_INT_MIN,
        2 => PHP_FLOAT_MAX,
        3 => PHP_FLOAT_MIN,
        'SimpleXMLElement' => new SimpleXMLElement("Hello, World!", "aardvark", "burrito")
    );
    return $a['SimpleXMLElement']->addAttribute(sqrt(2), "narwhal", "pineapple");
}

foo();
foo();
foo();

?>
