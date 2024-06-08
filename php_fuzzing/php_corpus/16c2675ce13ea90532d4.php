<?php

$host = 'localhost';
$port = 80; // Assuming default HTTP port

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

$onopen = function() use ($socket) {
    $log = function($msg) use ($socket) {
        $msg = '[WORKER X] '. $msg;
        socket_write($socket, $msg, strlen($msg));
    };

    $onmessage = function($m) use ($socket, $log) {
        $r = json_decode($m, true);
        try {
            echo json_encode($r);
        } catch (Exception $e) {
            echo json_encode(array());
        }
        $log('Message received: '. $m);
    };

    echo 'Ready';
};

$log('Connected to socket');
$onopen();

?>
