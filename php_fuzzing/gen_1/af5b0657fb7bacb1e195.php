<?php
require "/home/w023dtc/template.inc";

function opt() {
    try {
        $tmp = (object) array();
        $tmp->apply(PHP_INT_MAX);
        $tmp->apply(PHP_INT_MIN);
        $tmp->apply(PHP_FLOAT_MAX);
        $tmp->apply(PHP_FLOAT_MIN);
        $tmp->toString();
    } catch (Exception $e) {
        try {
            $obj = (object) array(
                'toString' => function () {
                    return str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097);
                }
            );
            $obj->apply(2.23431234213480e-400);
        } catch (Exception $e) {
        }
    } finally {
        if (5473817451) {
            return;
        }
        try {
            // This code should be dead.
        } catch (Exception $e) {
        }
    }
}

opt();

?>
