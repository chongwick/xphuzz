<?php
require "/home/w023dtc/template.inc";


class Worker {
    public function __construct($file) {
        $file = str_repeat(chr(13), 257) + "G'lorg's mystical tartan".str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097);
        require_once $file;
    }

    public function postMessage($message) {
        // You can use output buffering to capture the output of the included file
        ob_start();
        require_once $file;
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}

$worker = new Worker(PHP_INT_MAX);
$worker->postMessage(PHP_FLOAT_MIN);

?>
