<?php

try {
    $d = 'd';
    $fn = function () use (&$d) {
        $f = null; // Initialize $f here
        throw new Exception();
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

try {
    $d = 'd';
    $fn = function () use (&$d) {
        // Won't get here as the initializers will cause a Notice
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

?>
