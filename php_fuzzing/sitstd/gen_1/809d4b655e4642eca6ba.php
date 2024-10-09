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

$ref_array = array();
assertThrows(function() {
    mb_ereg(str_repeat("%s%x%n", 0x100), str_repeat(chr(1), 65). chr(235). str_repeat(chr(235), 64). chr(1), $ref_array);
}, Exception::class);
?>
