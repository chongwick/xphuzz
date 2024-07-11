<?php

try {
    $d = 'd';
    $weird_constant = 0x1234567890abcdef;
    $non_existent_file = "C:\\\\Windows\\\\NonExistentFile.txt";
    $fn = function () use (&$d, &$weird_constant, &$non_existent_file) {
        $f = null; // Initialize $f here
        throw new Exception();
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

try {
    $d = 'd';
    $weird_constant = 0x1234567890abcdef;
    $non_existent_file = "C:\\\\Windows\\\\NonExistentFile.txt";
    $fn = function () use (&$d, &$weird_constant, &$non_existent_file) {
        // Won't get here as the initializers will cause a Notice
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

?>
