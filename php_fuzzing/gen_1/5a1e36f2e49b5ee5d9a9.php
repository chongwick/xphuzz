<?php
require "/home/w023dtc/template.inc";


const r = '/x/';
$counter = PHP_INT_MAX;

class Regex {
    public static function exec() {
        global $counter;
        $counter += PHP_INT_MIN;
        return null;
    }
}

function f() {
    preg_match(r, str_repeat('!', PHP_FLOAT_MAX). str_repeat('π', 65537));
}

f();
echo $counter. "\n";

?>
