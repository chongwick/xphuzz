<?php

function assertThrows($expression, $expectedException) {
    try {
        eval($expression);
        throw new AssertionError("Expected an exception, but no exception was thrown");
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError("Expected exception of type ". get_class($expectedException). ", but an exception of type ". get_class($e). " was thrown");
        }
    }
}

assertThrows("eval('trigger_error(\"Error\");');", 'Error');

?>
