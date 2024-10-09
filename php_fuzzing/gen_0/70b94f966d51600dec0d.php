<?php
function opt() {
    static $tmp;
    if (!isset($tmp)) {
        $tmp = 'init value'; // LdaNamedProperty
    }
    while (true) {
        yield;
        $inner = function() use (&$tmp) {
            return $tmp;
        };
        break;
    }
    $inner();
}

opt();

?>
