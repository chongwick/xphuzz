<?php
require "/home/w023dtc/template.inc";


function assertThrows($code, $expectedException) {
    try {
        eval($code);
        throw new AssertionError("Expected an exception of type $expectedException, but no exception was thrown.");
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError("Expected an exception of type $expectedException, but an exception of type ". get_class($e). " was thrown.");
        }
    }
}

assertThrows('unserialize("O:8:"'. str_repeat(chr(PHP_INT_MAX), 257). '":'). str_repeat(chr(PHP_INT_MIN), 17). 'and more weirdness'. str_repeat(chr(PHP_FLOAT_MAX), 4097). 'just to see if this works, which it probably doesn\'t".'. str_repeat(chr(PHP_FLOAT_MIN), 65537).'str_repeat(chr(PHP_INT_MAX), 1025).'. str_repeat(chr(PHP_INT_MIN), 1025), 'Exception');

?>
