<?php
class Node {
  public $a = 1;
  public function __construct() {
    $this->a = 3;
  }
}

function for_in_null() {
  try {
    foreach ([] as $x) {
    }
  } catch (Exception $e) {
  }
}

function gc() {
  // PHP does not have a built-in garbage collector like JavaScript
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