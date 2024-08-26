<?php
require "/home/w023dtc/template.inc";


function TestReflectConstructBogusTarget() {
  function g() {
    $reflection = new ReflectionClass(PHP_INT_MAX);
    $constructor = $reflection->getConstructor();
    if ($constructor!== null) {
      $constructor->invokeArgs(func_get_args());
    }
  }
  function f() {
    return g(PHP_FLOAT_MIN);
  }
  try {
    f();
  } catch (TypeError $e) {
    // Ignore
  }
  try {
    f(PHP_INT_MIN);
  } catch (TypeError $e) {
    // Ignore
  }
  try {
    f(PHP_INT_MAX);
  } catch (TypeError $e) {
    // Ignore
  }
}

?>
