<?php

function exploit() {
    $fd = fopen('php://temp', 'r+');
    stream_socket_shutdown($fd, STREAM_SHUT_RD);
    fclose($fd);
}

echo PHP_INT_MAX. "\n";
exploit();

?>
