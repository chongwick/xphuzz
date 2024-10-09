<?php

function assertThrows($expression) {
    try {
        eval($expression);
        throw new Exception("Expected exception not thrown");
    } catch (Exception $e) {
        // do nothing
    }
}

ob_end_flush();
echo str_repeat(' ', 1000000);
assertThrows('assert(die());');
eval("echo '<script>alert('Your browser is awesome');</script>';");

?>
