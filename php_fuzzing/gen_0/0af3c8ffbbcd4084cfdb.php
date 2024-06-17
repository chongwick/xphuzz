<?php

class TestError extends Exception {}

$a = array();

for ($i = 0; $i < 10000; $i++) {
    $a[] = null;
}

$a[0] = (object) array('toString' => function() {
    throw new TestError();
});

// Verify join throws test error and does not fail due to asserts (Negative
// length fixed array allocation).
try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

?>
