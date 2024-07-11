<?php

const r = '/x/';
$counter = 0;

class Regex {
    public static function exec() {
        global $counter;
        $counter++;
        return null;
    }
}

function f() {
    preg_match(r, 'ABcd');
}

$vars["ReflectionClassConstant"]->__construct(
    "0",
    str_repeat("%s%x%n", PHP_INT_MAX)
);

f();
echo $counter. "\n";
f();
echo $counter. "\n";

?>
