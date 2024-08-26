<?php
require "/home/w023dtc/template.inc";

function to_string($value) {
    return serialize($value);
}

$dom_attr = new DOMAttr('category', 'books');
$dom_attr_clone = unserialize(to_string($dom_attr));
class my_test {
    private function __get() {
        return null;
    }
}
$clone = new my_test();
?>
