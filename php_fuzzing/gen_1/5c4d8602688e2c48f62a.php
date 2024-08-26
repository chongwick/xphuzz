<?php
require "/home/w023dtc/template.inc";


function f($name = []) {
    $name = array();
}

f([]);

call_user_func(function() {
    call_user_func(function($name = []) {
        $name = array();
    }, []);
});

$f = fn($name = []) => array();
$f();

$g = fn($name = []) => array();
$g();

$vars["SimpleXMLElement"]->addAttribute(
    str_repeat(chr(42), 257),
    PHP_INT_MAX. PHP_FLOAT_MAX. str_repeat(chr(45), 1025),
    chr(0x1d0f),
    str_repeat(chr(0x13a2), 17). PHP_INT_MIN. PHP_FLOAT_MIN,
    strtr("πωо Foo bar baz", array("π" => "H", "ω" => "W", "о" => "o", "F" => "ƒ", "b" => "β", "z" => "ζ"))
);

?>
