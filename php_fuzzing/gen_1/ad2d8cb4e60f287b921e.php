<?php
require "/home/w023dtc/template.inc";

function varToString($var) {
    $v0 = PHP_INT_MAX;
    $realmShared = null; // Declare the global variable
    function f0($iteration = 0) {
        global $v0;
        global $realmShared; // Declare the global variable
        try {
            if ($iteration < 50) {
                $v0++;
                // This line is equivalent to the regular expression replacement in JavaScript
                $pattern = '~()~'; // Corrected regular expression pattern
                $replacement = ''; // Corrected replacement string
                $string = preg_replace($pattern, $replacement, '');
                f0($iteration + 1);
            }
        } catch (Exception $e) {
            // Handle the exception
        }
    }
    f0();
    $obj = new DOMAttr('category', 'books');
    $script1_dataflow = $obj;
    class test {
        private function __clone() {
        }
    }
    $clone = clone $script1_dataflow;
    echo -ne 'O:8:"stdClass":'. str_repeat(chr(0), $v0). "\n";
?>
