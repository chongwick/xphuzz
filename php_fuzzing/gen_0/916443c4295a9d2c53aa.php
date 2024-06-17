<?php

class F {
  public function __construct($func) {
    $this->func = $func;
  }

  public function __invoke() {
    return $this->func();
  }
}

$f = new F(function() use (&$f) {
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
