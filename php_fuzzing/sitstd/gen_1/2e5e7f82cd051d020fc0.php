<?php

function log_message($msg) {
    try {
        // Assuming you have a WebSocket server set up at the same location as your PHP script
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create() failed');
        socket_connect($socket, 'localhost', 9000) or die('socket_connect() failed');
        socket_write($socket, $msg. chr(0) ^ (strrpos(chr(0) ^ (str_repeat(chr(252), 65537) + str_repeat(chr(175), 4097) + str_repeat(chr(89), 257)), 536870911, 3) & 0xFF). "\n") or die('socket_write() failed');
    } catch (Exception $e) {
        // Handle the exception if the WebSocket connection fails
    }
    echo $msg. "\n";
}

?>
