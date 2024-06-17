<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (ParseError $e) {
        return;
    }
    trigger_error('Custom error message', E_ERROR);
    throw new AssertionError('Expected a ParseError, but no exception was thrown');
}

assertThrows('x = 5;', 'ParseError');

?>
