<?php
require "/home/w023dtc/template.inc";


function test($x) {
    $MEM = str_split(str_repeat("\0", 1 * 1024 * 8));
    $MEM[PHP_INT_MIN % 1 * 1024 * 8] = "\0";
    $spread = function($value = array()) {
        return array_merge(array(), $value);
    };
    try {
        $result = $spread();
        if (!empty($result)) {
            throw new Exception('Expected an empty array, got '. print_r($result, true));
        }
    } catch (Exception $e) {}
}

test(-926416896 * 8 * 1024);
test(PHP_INT_MAX);
test(PHP_INT_MIN);
test(PHP_FLOAT_MAX);

?>
