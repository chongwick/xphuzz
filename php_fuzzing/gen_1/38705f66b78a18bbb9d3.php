<?php
require "/home/w023dtc/template.inc";


class F {
  public function __construct($func) {
    $this->func = $func;
  }

  public function __invoke() {
    return $this->func();
  }
}

$f = new F(function() use (&$f) {
  $v2 = array(13.37);
  $v3 = PHP_INT_MAX;
  $v2 = array();
  $v5 = array_merge($v2, array($v3));
  for ($v9 = 0; $v9 < 100; $v9++) {
    $v11 = new \stdClass();
    $v12 = $v11->$v5;
  }
  return 'use strict';
});

// Create enough objects to complete slack tracking.
for ($i = 0; $i < 20; $i++) {
  $f = new F(function() {
    return 'use strict';
  });
}

gc_collect_cycles();

?>

