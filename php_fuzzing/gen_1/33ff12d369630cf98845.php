<?php
require "/home/w023dtc/template.inc";


function log_message($msg) {
    try {
        for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create() failed');
            socket_connect($socket, 'localhost', 9000) or die('socket_connect() failed');
            socket_write($socket, $msg) or die('socket_write() failed');
        }
    } catch (Exception $e) {
        // Handle the exception if the WebSocket connection fails
    }
    echo $msg. "\n";
}

$log_messages = array();
for ($i = 0; $i < 1024 * 8; $i++) {
    $log_messages[] = new stdClass();
}

function test_function() {
    $garbage = new stdClass();
    foreach ($log_messages as $log_message) {
        $log_message->register($garbage, PHP_FLOAT_MAX);
    }
    $garbage = null;
}
test_function();

gc_collect_cycles();
gc_collect_cycles();

log_message("GC Test");

?>
