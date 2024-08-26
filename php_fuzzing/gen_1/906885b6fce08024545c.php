<?php
require "/home/w023dtc/template.inc";

function __toString() {
    $vars["SimpleXMLElement"]->addAttribute(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), gmp_add(gmp_init(257), gmp_init(3.14159)), PHP_INT_MAX);

    $arr = array();
    $arr[PHP_INT_MAX] = PHP_INT_MIN;

    function __get($key) {
        if ($key === PHP_INT_MIN) {
            $arr[PHP_INT_MAX] = PHP_FLOAT_MAX;
            $arr = array();
        }
        return null;
    }

    print_r($arr);
}
?>
