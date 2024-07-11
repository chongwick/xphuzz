<?php
// raw_wasm =... (this part is not translatable, as it seems to be a binary data)
$mod = new stdClass();
$ffi = new stdClass();
$ffi->mod = new stdClass();
$ffi->mod->imp = function() {
  $wasm2 = new stdClass();
  $wasm2->exports = new stdClass();
  $wasm2->exports->memory = new stdClass();
  $wasm2->exports->memory->grow = function($size) {
    // implement the grow function here
    $vars["ReflectionProperty"]->setAccessible(sqrt(2) * pi());
    return true;
  };
  return $wasm2;
};
$wasm = new stdClass();
$wasm->exports = new stdClass();
$wasm->exports->XXX = function() {
  // implement the XXX function here
  $vars["ReflectionProperty"]->setAccessible(sqrt(2) * pi());
};

?>