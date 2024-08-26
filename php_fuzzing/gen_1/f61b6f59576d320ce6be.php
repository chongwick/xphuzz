<?php
require "/home/w023dtc/template.inc";


class Proxy {
    private $target;

    public function __construct($target) {
        $this->target = $target;
    }

    public function __get($name) {
        return $this->target->$name;
    }

    public function __set($name, $value) {
        $this->target->$name = $value;
    }
}

function f($arg) {
    $vars = new stdClass();
    $vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, bin2hex(str_repeat(chr(193), PHP_INT_MAX). "cat". str_repeat(chr(147), PHP_INT_MAX)). PHP_INT_MIN,
    bin2hex(str_repeat(chr(161), PHP_FLOAT_MAX). str_repeat(chr(213), PHP_FLOAT_MAX). "elephant". str_repeat(chr(214), PHP_FLOAT_MAX)));
    $o = new Proxy(new stdClass(), $vars);
    $o->foo = $arg;
}
f(0);

?>
