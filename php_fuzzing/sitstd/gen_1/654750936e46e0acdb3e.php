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

$vars["DateInterval"]->createFromDateString(str_repeat(chr(0x20). chr(0x73). chr(0x74). chr(0x72). chr(0x72). chr(0x72). chr(0x65). chr(0x78). chr(0x74). chr(0x6e), 0x100));

// Create enough objects to complete slack tracking.
for ($i = 0; $i < 20; $i++) {
  $f = new F(function() {
    return 'use strict';
  });
}

gc_collect_cycles();

?>
