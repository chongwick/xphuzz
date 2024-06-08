<?php

class O {
  public function m() {
    // implement m() method
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
