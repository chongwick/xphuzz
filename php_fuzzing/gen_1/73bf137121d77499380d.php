<?php
ini_set('memory_limit', '512M'); // increase the memory limit to 512MB
$str2 = chr(0x2c); // add `,` into single character string
$str2 = str_repeat($str2, 0x400000); // adjust the value to avoid memory exhaustion

$v17 = array();
$v32 = array();
$v39 = new stdClass();
$v39->buffer = new stdClass();
$v39->buffer->data = array();
$v39->buffer->byteLength = 0;
$v39->buffer->byteLength = array_merge($v39->buffer->data, $v17);
?>
