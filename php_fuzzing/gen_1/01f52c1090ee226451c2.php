<?php
require "/home/w023dtc/template.inc";

$arr = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $arr[] = new stdClass();
}
echo array_search(new stdClass(), $arr, false);

$mod = new stdClass();
$ffi = new stdClass();
$ffi->mod = new stdClass();
$ffi->mod->imp = function() {
  $wasm2 = new stdClass();
  $wasm2->exports = new stdClass();
  $wasm2->exports->memory = new stdClass();
  $wasm2->exports->memory->grow = function($size) {
    // implement the grow function here
  };
  return $wasm2;
};
$wasm = new stdClass();
$wasm->exports = new stdClass();
$wasm->exports->XXX = function() {
  // implement the XXX function here
};

echo serialize($arr);
echo serialize($mod);

// raw_wasm =... (this part is not translatable, as it seems to be a binary data)
$mod = unserialize('O:8:"00000000":');
$ffi = unserialize('c:13:"ArrayObject":1:{s:6:"storage";r:2;}');
$wasm = unserialize('O:8:"stdClass":');

?>
