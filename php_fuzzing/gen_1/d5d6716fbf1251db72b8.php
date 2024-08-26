<?php
require "/home/w023dtc/template.inc";


function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

assertThrows("str_repeat(chr(PHP_INT_MAX), 257).pack('na*', str_repeat(chr(155), 17), str_repeat(chr(147), PHP_INT_MIN));", 'Error');

?>
