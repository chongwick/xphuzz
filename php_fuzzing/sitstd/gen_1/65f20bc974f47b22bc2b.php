<?php

class F {
  public function __construct($func) {
    $this->func = $func;
  }

  public function __invoke() {
    return $this->func();
  }
}

function myFunction($foo = []) {
    return $foo;
}

$f = new F(function() use (&$f) {
  return 'use strict';
});

myFunction(array());

// Create enough objects to complete slack tracking.
for ($i = 0; $i < 20; $i++) {
  $f = new F(function() {
    return 'use strict';
  });
}

gc_collect_cycles();

?>
