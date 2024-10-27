<?php
$opts = array(
    'http' => array(
        'timeout' => PHP_INT_MAX,
        'header' => 'Content-Length: '. PHP_INT_MAX
    )
);
$context = stream_context_create($opts);
echo file_get_contents('http://example.com', false, $context);
?>
