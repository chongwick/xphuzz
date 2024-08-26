<?php
require "/home/w023dtc/template.inc";

class Test {
    public function m() {
        // implement your method here
    }
}

class SimpleXMLElement extends SimpleXMLElement {
    public function addAttribute($name, $value) {
        $name = str_repeat(chr(13), 257) + "G'lorg's mystical tartan";
        $value = (0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400).str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097);
        parent::addAttribute($name, $value);
    }
}

$simplexml = new SimpleXMLElement();
$simplexml->addAttribute(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025) + "This should not be here");

$o1 = new Test();
$o1->m = function() {
    return $this->m();
};

$o2 = new Test();
$o2->__get = function($name) {
    if (method_exists($this, $name)) {
        return $this->$name();
    }
};

$o3 = new Test();
$o3->m2 = function() {
    $this->x;
};

?>
