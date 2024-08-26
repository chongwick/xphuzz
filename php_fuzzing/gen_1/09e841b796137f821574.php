<?php
require "/home/w023dtc/template.inc";


class Gerbil {
    public function __toString() {
        return PHP_INT_MAX;
    }
}

$vars["Gerbil"]->addAttribute(str_split(serialize(new Gerbil()))[PHP_INT_MAX], str_split("\u{1000000}")[PHP_INT_MAX], str_split("I'm a secret code ")[PHP_INT_MAX]);

foo('a');
foo('\u{1000000}'); 
// This is a comment, not actual PHP code
foo('a');
foo('');
// This is a comment, not actual PHP code

function foo($s) {
    return $s. PHP_FLOAT_MAX;
}

?>
