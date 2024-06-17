<?php

// Attempt to externalize a string that's in RO_SPACE, which is not allowed as 
// the string's map would need to be writable.

function assertThrows($callback) {
    try {
        $callback();
        die('Assertion failed');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() {
    externalizeString('1', false);
});

assertThrows(function() {
    externalizeString('1', true);
});

function externalizeString($str, $writable) {
    // Your implementation here
}

?>

