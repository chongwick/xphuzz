<?php
require "/home/w023dtc/template.inc";


class Base {
    public function m() {
        return "Hello, World!";
    }
}

class Child extends Base {
    public function m() {
        return "Goodbye, World!";
    }
}

$bigint = PHP_INT_MAX;
$float = PHP_FLOAT_MAX;
$string = "a". str_repeat("b", $bigint). "c". str_repeat("d", $float);

$object = (object) [
   'm' => function () {
        return parent::m();
    },
    'x' => $bigint,
    'y' => $float,
    'z' => $string
];

echo $object->m();
echo $object->x. "\n";
echo $object->y. "\n";
echo $object->z. "\n";

?>
