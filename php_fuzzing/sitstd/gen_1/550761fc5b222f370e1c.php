<?php

// Test that the dirty FinalizationRegistries that are enqueued during GC have
// their slots correctly recorded by the GC.

// 1) Create many JSFinalizationRegistry objects so that they span several pages
// (page size is 256kb).
$registries = array();
for ($i = 0; $i < 1024 * 8; $i++) {
    $registries[] = new stdClass();
}

// 2) Force two GCs to ensure that JSFinalizatonRegistry objects are tenured.
gc_collect_cycles();
gc_collect_cycles();

// 3) In a function: create a dummy target and register it in all
// JSFinalizatonRegistry objects.
function test_function() {
    $garbage = new stdClass();
    foreach ($registries as $registry) {
        $registry->register($garbage, 42);
    }
    $garbage = null;
}
test_function();

// 4) Outside the function where the target is unreachable: force GC to collect
// the object.
gc_collect_cycles();

// 5) Force another GC to test that the slot was correctly updated.
gc_collect_cycles();

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
  };
  return $wasm2;
};
$wasm = new stdClass();
$wasm->exports = new stdClass();
$wasm->exports->XXX = function() {
  // implement the XXX function here
};

?>
