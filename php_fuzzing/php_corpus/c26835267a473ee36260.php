<?php

function assertThrows($callable, $expectedException) {
    try {
        $callable();
        throw new AssertionError('Expected exception of type '. get_class($expectedException));
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError('Expected exception of type '. get_class($expectedException). ', got '. get_class($e));
        }
    }
}

// Make a function with 65535 args. This should throw a SyntaxError because -1
// is reserved for the "don't adapt arguments" sentinel.
$f_with_65535_args = function () {
    return;
};

assertThrows(function () use ($f_with_65535_args) {
    $f_with_65535_args();
}, \Exception::class);

?>
