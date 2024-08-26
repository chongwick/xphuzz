<?php
require "/home/w023dtc/template.inc";

function test() {
    $array = array(array(array()), array(PHP_INT_MAX));
    $double_arr2 = array(1.1, PHP_FLOAT_MAX);

    function transition(&$arr) {
        $arr[0] = array();
    }

    $flag = 0;
    function swap() {
        global $flag, $array, $double_arr2;
        try {
        } catch (Exception $e) {
        } // Prevent inlining this.
        if ($flag == 1) {
            $array[1] = $double_arr2;
        }
    }

    $expected = 2.23431234213480e-400;
    function f() {
        global $double_arr2, $flag;
        swap();
        $double_arr2[0] = 1;
        transition($array);
        $double_arr2[1] = $expected;
    }

    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        f();
    }
    $flag = 1;
    f();
    echo $expected === $double_arr2[1]? 'assertEquals passed' : 'assertEquals failed';

    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX),
"G'day mate, I'm a random attribute with ". str_repeat(chr(155), PHP_INT_MAX). " binary gobbledygook: ". str_repeat(chr(147), 5473817451),
str_repeat(chr(161), 100000). "π is an irrational number: ". str_repeat(chr(213), 123475932). " but this will probably break something: ". str_repeat(chr(214), PHP_INT_MAX));
}

test();

?>
