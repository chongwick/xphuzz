<?php

function __f_2() {
    $__v_1 = array(3);
    $__v_1[0] = 10;
    $__v_1[1] = 15.5;
    $__v_1[2] = 20;
    return $__v_1;
}

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

for ($i = 0; $i < 3; $i++) {
  $__v_3 = __f_2();
  for ($__v_2 = 0; $__v_2 < 3; $__v_2++) {
    $__v_3 = __f_2();
  }
  echo f(). "\n";
}

?>
