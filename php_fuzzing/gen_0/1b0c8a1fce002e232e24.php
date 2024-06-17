<?php
function assertThrows($callable, $expectedException) {
    try {
        $callable();
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError('Assertion failed');
        }
        throw $e;
    }
    throw new AssertionError('Assertion failed');
}

?>