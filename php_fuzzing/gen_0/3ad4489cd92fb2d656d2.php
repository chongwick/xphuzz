<?php
$url = 'http://example.com/file';
while (1) {
    $stream = fopen("php://output", "w+");
    fwrite($stream, str_repeat(chr(0), PHP_INT_MAX));
    fclose($stream);
    $content = stream_get_contents($url);
}
?>
