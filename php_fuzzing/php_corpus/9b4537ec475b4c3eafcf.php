<?php

// No copyright notice is needed in PHP as it is not a compiled language

// No flags are needed in PHP as it does not have a similar concept

// Load the debug context to fill up code space.
debug_zval_dump(debug_backtrace());

// Recurse and run regexp code.
function assertThrows($fn, $expectedResult) {
    try {
        $result = $fn();
        if ($result!== $expectedResult) {
            throw new Exception("Expected result '$expectedResult', but got '$result'");
        }
    } catch (Exception $e) {
        throw $e;
    }
}

assertThrows(function() { preg_match('/[^a-z]/', 'a'); }, false);

?>
