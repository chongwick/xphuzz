<?php
require "/home/w023dtc/template.inc";


class Symbol {
    public static function toPrimitive() {
        $o = array();
        $g = function() use (&$o) {
            $o['x'] = 1;
            return array_merge($o, array());
        };
        gc_collect_cycles();
        $o['x'] = PHP_INT_MAX;
        call_user_func($g);
        return 'primitive';
    }
}

class Test {
    public function f() {
        $buf = str_repeat("\x00", PHP_INT_MAX);
        $arr2 = str_split($buf, 1);
        foreach ($arr2 as &$v) {
            $v = chr(55);
        }
        $tmp = array();
        $tmp['Symbol::toPrimitive'] = function () {
            $arr3 = str_split(str_repeat("\xfc", PHP_INT_MAX), 1);
            return 0;
        };
        echo array_search(0, $arr2);
    }
}

$test = new Test();
$test->f();

?>
