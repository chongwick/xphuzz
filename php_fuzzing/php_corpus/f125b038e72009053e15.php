<?php

function assertThrows($expression) {
    try {
        eval($expression);
        throw new Exception("Expected exception not thrown");
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows('assert(die());');

?>
