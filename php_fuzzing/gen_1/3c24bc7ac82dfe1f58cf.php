<?php
require "/home/w023dtc/template.inc";

function TestReflectConstructBogusTarget() {
  function g() {
    $reflection = new ReflectionClass(0);
    $constructor = $reflection->getConstructor();
    if ($constructor!== null) {
      $constructor->invokeArgs(func_get_args());
    }
  }
  function f() {
    return g(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN);
  }
  try {
    f();
  } catch (TypeError $e) {
    // Ignore
  }
  try {
    f();
  } catch (TypeError $e) {
    // Ignore
  }
}

echo TestReflectConstructBogusTarget();
?>
