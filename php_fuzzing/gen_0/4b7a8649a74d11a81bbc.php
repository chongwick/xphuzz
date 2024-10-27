<?php
stream_wrapper_register('test', 'TestStream');
class TestStream {
    public function stream_open($path, $mode) {
        return true;
    }
    public function stream_read($count) {
        return str_repeat(chr(0), PHP_INT_MAX);
    }
}

?>