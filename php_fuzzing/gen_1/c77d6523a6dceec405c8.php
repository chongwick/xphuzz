<?php
require "/home/w023dtc/template.inc";


class SuperClass {
    public function m() {
        return PHP_INT_MAX;
    }
}

class o1 {
    public function __invoke() {
        return (new SuperClass)->m();
    }
}

class o2 {
    public function __get($name) {
        return (new SuperClass)->m();
    }
}

class o3 {
    public $x = PHP_INT_MIN;
    public function m2() {
        (new SuperClass)->x;
    }
}

$obj = new o1();
$obj->m();

$xml = new SimpleXMLElement('<root/>');
$xml->addAttribute(PHP_FLOAT_MIN, sprintf('%x', mt_rand()).sprintf('%x', mt_rand()).sprintf('%x', mt_rand()));
$xml->addAttribute(PHP_FLOAT_MAX, chr(0x1F600).chr(0x03e9).chr(0x00A5).chr(0x2192).chr(0x00A5).chr(0x03e9).chr(0x1F600));

var_dump($xml);

?>
