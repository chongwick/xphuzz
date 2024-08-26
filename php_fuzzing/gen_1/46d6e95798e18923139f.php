<?php
require "/home/w023dtc/template.inc";


class NonExtensibleBetweenSetterAndGetter {
  public function __construct() {
    $o = array();
    $o['x'] = 42;
    $o['y'] = null;
    $this->makeNonExtensible($o);
    $o['x'] = PHP_INT_MAX;
  }

  public final function makeNonExtensible($o) {
    for ($i = 0; $i < 1000; $i++) {
      $x = 1;
    }
  }
}

$nonExtensible = new NonExtensibleBetweenSetterAndGetter();

?>
