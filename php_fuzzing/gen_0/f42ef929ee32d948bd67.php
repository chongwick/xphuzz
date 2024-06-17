<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

assertThrows("function f() { function g() { }; }", 'ParseError');

?>
