<?php
$stream = fopen('php://temp', 'w+');
stream_filter_append($stream, 'convert.iconv.UTF-16BE.UTF-8');
stream_filter_append($stream, 'convert.iconv.UTF-16BE.UTF-16BE');
fputs($stream, 'test');
rewind($stream);
echo stream_get_contents($stream);
fclose($stream);
?>
