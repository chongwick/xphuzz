<?php
function TestReflectConstructBogusTarget() {
  function g() {
    $reflection = new ReflectionClass('stdClass');
    $constructor = $reflection->getConstructor();
    if ($constructor!== null) {
      $constructor->invokeArgs(func_get_args());
    }
  }
  function f() {
    return g();
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

?>