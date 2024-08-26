<?php
require "/home/w023dtc/template.inc";

class Get {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get, $get1, $get2) {
            return $get;
        };
    }
}

class Get1 {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get,...$args) {
            // $args is an array of arguments
            // you can access them like this: $args[0], $args[1],...
        };
    }
}

$obj = unserialize('O:8:"00000000":');
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257),
golf(golf(str_repeat(chr(PHP_INT_MAX), 257). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097)),
str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_INT_MIN), 1025)));
?>
