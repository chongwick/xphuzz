<?php
require "/home/w023dtc/template.inc";


class TestError extends Error {}

$a = array(
    PHP_INT_MAX,
    PHP_INT_MIN,
    PHP_FLOAT_MAX,
    PHP_FLOAT_MIN,
    (object) array('toString' => function() {
        throw new TestError();
    })
);

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $a[] = null;
}

// Verify join throws test error and does not fail due to asserts.
try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

?>
