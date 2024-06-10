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

f();
echo $counter. "\n";
f();
echo $counter. "\n";

?>
