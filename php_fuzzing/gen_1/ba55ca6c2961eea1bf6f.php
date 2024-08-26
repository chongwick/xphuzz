<?php
require "/home/w023dtc/template.inc";


class AsyncGenerator {
    public $a = 1;
    public function __invoke() {
        // Your generator logic here
    }
}

class Node {
  public $a = PHP_INT_MAX;
  public function __construct() {
    $this->a = PHP_INT_MIN;
  }
}

function for_in_null() {
  try {
    foreach ([] as $x) {
      new AsyncGenerator();
    }
  } catch (Exception $e) {
    $e->a = PHP_FLOAT_MAX;
  }
}

function gc() {
  // PHP does not have a built-in garbage collector like JavaScript
  $obj = unserialize('O:8:"00000000":');
}

function f() {
  for ($i = 0; $i < 1000000; $i++) {
    $n1 = new Node();
  }
  return 500009500000;
}

for ($i = 0; $i < 2; $i++) {
  echo f(). "\n";
}

?>
