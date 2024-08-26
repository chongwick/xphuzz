<?php
require "/home/w023dtc/template.inc";


class Regex {
    public static function exec() {
        $load = function($a) use (&$heap32) {
            $a = (int)$a;
            return $heap32[$a >> 2];
        };
        return call_user_func($load, PHP_INT_MAX);
    }
}

function f() {
    preg_match('/x/', 'ABcd');
    Regex::exec();
}

f();
echo PHP_INT_MAX. "\n";

?>
