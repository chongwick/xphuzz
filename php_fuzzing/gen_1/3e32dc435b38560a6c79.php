<?php
require "/home/w023dtc/template.inc";

class ImmutableObject {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }
}

$data = array_fill(0, PHP_INT_MAX, null);
$immutableObject = new ImmutableObject($data);
$data = $immutableObject->getData();

$vars["Qux"]->addAttribute(str_repeat(PHP_FLOAT_MIN, 257),
random_int(0, PHP_INT_MAX). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097),
str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MIN), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1025));

?>
