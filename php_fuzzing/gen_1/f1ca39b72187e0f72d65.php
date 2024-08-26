<?php
require "/home/w023dtc/template.inc";

$v17 = array_fill(0, PHP_INT_MAX, 0);
$v32 = array_fill(0, PHP_FLOAT_MAX, 0.0);
$v39 = new stdClass();
$v39->buffer = new stdClass();
$v39->buffer->data = array();
$v39->buffer->byteLength = PHP_INT_MIN;
$v39->buffer->byteLength = array_merge($v39->buffer->data, $v17);
$v1 = array_merge($v32, $v39->buffer->data);

function f12($v6) {
    if ($v6 < 0) {
        $v1 = array_fill(0, PHP_FLOAT_MIN, 0.0);
    }
}
f12(PHP_INT_MIN);
f12(PHP_INT_MIN);

?>
