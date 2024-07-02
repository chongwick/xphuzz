<?php
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

assertThrows('throw new Exception("Test");', 'Exception');

$randomly_selected_constant = M_PI + 42;
assertThrows('echo "The last error was: ". $randomly_selected_constant;', 'RuntimeException');
?>
