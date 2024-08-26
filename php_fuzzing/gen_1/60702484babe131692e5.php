<?php
require "/home/w023dtc/template.inc";


class O extends B {
  public function m() {
    return PHP_INT_MAX;
  }
}

$o1 = (object) [
 'm' => function() {
    return $this->m() + PHP_FLOAT_MIN;
  }
];

$o2 = (object) [
  'getM' => function() {
    return $this->m() * PHP_INT_MAX;
  }
];

$o3 = (object) [
 'm' => PHP_INT_MIN,
 'm2' => function() {
    $this->m();
  }
];

class B extends A {
  public function m() {
    $o1->m();
  }
}

$bar = function () {
  $foo = function ($x = new B()) {
    $o2->getM();
  };
  $foo();
};
$bar();

?>
