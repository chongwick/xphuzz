<?php

class Worker {
    public function __construct($file) {
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

register_shutdown_function(function() {
    echo "<pre>";
    phpinfo();
    echo str_repeat("A", 0x100);
    echo "</pre>";
}, str_repeat("A", 0x100));

$worker = new Worker('path_to_your_file.php');
$worker->postMessage('Hello, World!');

?>
