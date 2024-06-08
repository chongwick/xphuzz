<?php

function assertThrows($fn, $expectedException) {
    try {
        $fn();
        throw new AssertionError('Expected exception of type '. get_class((new $expectedException)));
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

assertThrows(function() {
    preg_match('/(a?;?){400000}/', 'a');
}, 'RuntimeException');

?>
