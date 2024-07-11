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

$vars["SplFileObject"]->getCsvControl() = "ðŸŽ‰ðŸ’¥ðŸ”¥";


?>