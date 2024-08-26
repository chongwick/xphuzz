<?php
require "/home/w023dtc/template.inc";

function assertThrows($callable, $expectedException) {
    try {
        $callable();
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError('Assertion failed');
        }
        throw $e;
    }
    throw new AssertionError('Assertion failed');
}

assertThrows(function () {
    $vars["SimpleXMLElement"]->addAttribute(str_rot13("banana"), strtr("ðŸŽ¶", array("ðŸŽ¶" => chr(PHP_INT_MAX))), str_pad(pi(PHP_INT_MIN, 100), PHP_FLOAT_MAX, chr(0x21)));
}, E_ERROR);
?>
