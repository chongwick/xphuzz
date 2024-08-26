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
  return PHP_INT_MAX;
});

// Create enough objects to complete slack tracking.
for ($i = 0; $i < PHP_INT_MAX; $i++) {
  $f = new F(function() {
    return PHP_INT_MIN;
  });
}

gc_collect_cycles();

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_FLOAT_MAX), PHP_FLOAT_MIN, "This is a test string... or is it? ". sprintf("%e", PHP_FLOAT_MIN));

?>

