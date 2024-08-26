<?php
require "/home/w023dtc/template.inc";


class A {
    public $name;
}

$obj = new A;
unset($obj->name);
$class_num = $obj;

$b2 = array(
    PHP_INT_MAX,
    PHP_INT_MIN,
    PHP_FLOAT_MAX,
    PHP_FLOAT_MIN,
    str_repeat("\0", 0x10),
    str_repeat("\0", 0x61),
    str_repeat("\0", 0x73),
    str_repeat("\0", 0x6d),
    str_repeat("\0", 0x1),
    str_repeat("\0", 0x7f),
    str_repeat("\0", 0x23),
    str_repeat("\0", 0x2),
    str_repeat("\0", 0x6a),
    str_repeat("\0", 0x73),
    str_repeat("\0", 0x3),
    str_repeat("\0", 0x6d),
    str_repeat("\0", 0x65),
    str_repeat("\0", 0x6d),
    str_repeat("\0", 0x2),
    str_repeat("\0", 0x0),
    str_repeat("\0", 0x1),
    str_repeat("\0", 0x7),
    str_repeat("\0", 0x69),
    str_repeat("\0", 0x6d),
    str_repeat("\0", 0x70),
    str_repeat("\0", 0x6f),
    str_repeat("\0", 0x72)
);

unserialize(serialize($obj). serialize($b2));

?>
