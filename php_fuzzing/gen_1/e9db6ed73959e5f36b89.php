<?php
require "/home/w023dtc/template.inc";


class Base {
    public function m() {
        return PHP_INT_MAX;
    }
}

class Child extends Base {
    public function m() {
        return PHP_INT_MIN;
    }
}

$o1 = (object) [
  'm' => function () {
        return parent::m();
    }
];

$o2 = (object) [
  'm' => function () {
        return parent::m();
    }
];

$o3 = (object) [
  'm2' => function () {
        return parent::m();
    }
];

$x = unserialize('O:8:"stdClass":'.str_repeat(chr(13), PHP_INT_MAX));
echo $x->m();

?>

