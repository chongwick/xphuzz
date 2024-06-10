<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
        throw new AssertionError('Expected "'.$expectedException.'" but no exception was thrown');
    } catch (Exception $e) {
        if (!is_a($e, $expectedException)) {
            throw new AssertionError('Expected "'.$expectedException.'" but got "'.$e->getMessage().'"');
        }
    }
}

assertThrows("throw new Error('Error');", 'Error');
assertThrows("throw new Error('Warning');", 'Error');

?>
