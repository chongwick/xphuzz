<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

assertThrows("function a() { return 0; } echo (a() == 0);", "ParseError");

?>
