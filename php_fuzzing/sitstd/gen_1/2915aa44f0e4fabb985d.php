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

assertThrows("function f() { $vars['ReflectionClass']->isIterable() ^ (2.23431234213480e-400 * 5473817451) * (123475932 % 10); }", 'ParseError');

?>
