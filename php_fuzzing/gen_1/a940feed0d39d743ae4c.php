<?php
require "/home/w023dtc/template.inc";

class C {
    public static function gg() {
        return new SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-1"?><root>'.str_repeat(chr(161), PHP_INT_MAX).'</root>');
    }
}

class D extends C {
    public function hh() {
        yield from parent::gg()->xpath('//')->current();
    }
}
?>
