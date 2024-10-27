<?php
while (1) {
    $read = array($fp = fopen('php://fd/1', 'r+'));
    $write = array($fp);
    $except = array($fp);
    $timeout = PHP_INT_MAX;
    $n = stream_select($read, $write, $except, $timeout);
    if ($n === false) {
        echo "Error: ". stream_select_error(). "\n";
    }
}
?>
