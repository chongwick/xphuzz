<?php
require "/home/w023dtc/template.inc";


define('WASM_TESTS_DIR', PHP_INT_MAX);

class Malicious {
    public function __construct($file) {
        require_once $file;
    }

    public function crashPHP($value) {
        echo str_repeat(chr(0x0a), PHP_INT_MIN);
    }
}

$worker = new Malicious(WASM_TESTS_DIR. '/non_existent_file.php');
$worker->crashPHP(PHP_FLOAT_MAX);

?>
