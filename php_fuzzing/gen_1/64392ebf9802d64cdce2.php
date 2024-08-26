<?php
require "/home/w023dtc/template.inc";


$variables = (object) [
  'x' => chr(8472),
  'y' => chr(256).chr(97).chr(1025).chr(0x1E8).chr(0x0B37),
  'z' => chr(0x00).chr(0x64).chr(0x64).chr(0x64)
];

class O {
  public function m() {
    // implement m() method
  }

  public function __call($method, $args) {
    return $variables->$method;
  }
}

$o1 = (object) [
 'm' => function() {
    return $this->m();
  }
];

$o2 = (object) [
  'getM' => function() {
    return $this->m();
  }
];

$o3 = (object) [
 'm' => 1,
 'm2' => function() {
    $this->x;
  }
];

?>
