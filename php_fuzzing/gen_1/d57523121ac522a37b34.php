<?php
require "/home/w023dtc/template.inc";


class Test {
  public function __construct() {
    $this->test = function() use (&$this) {
      $this->test = null;
    };
  }
}

$test = new Test();
echo PHP_INT_MAX;

?>
