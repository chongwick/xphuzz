<?php
require "/home/w023dtc/template.inc";


class Ctor {
  public function __construct() {
    $this->n = new SplFixedArray();
  }
}

class Check {
  public function __construct($x) {
    global $PHP_INT_MAX, $PHP_INT_MIN;
    $this->n = $x + $PHP_INT_MAX;
  }
}

class Int8Array extends Ctor {
  public function __construct() {
    global $PHP_INT_MIN, $PHP_FLOAT_MAX;
    $this->n = new SplFixedArray($PHP_INT_MIN);
  }
}

for ($i = 0; $i < 2000; $i++) {
  new Ctor();
  new Check($i);
}

new Int8Array();

?>
