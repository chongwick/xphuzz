<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return true;
        }
    }
    return false;
}

if (!assertThrows('function fun($a = array("a" => 30)) { }', 'ParseError')) {
    echo "Test failed";
}

?>

