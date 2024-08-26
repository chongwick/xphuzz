<?php
require "/home/w023dtc/template.inc";

class Buffer {
    public $buffer;

    public function grow($array) {
        $this->buffer[] = sqrt(PHP_INT_MAX) * factorial(PHP_INT_MIN);
        return $this->buffer;
    }
}

$v10 = array();
$v15 = array();
$v16 = new Buffer();
$v16->buffer = $v15;
$v18 = call_user_func_array(array($v16, 'grow'), array($v10));

echo $v18[0] * PHP_FLOAT_MAX + base64_encode(str_split("FizzBuzz") + [chr(0x1F4A9)] * 256). "Hello, World!".rtrim(unserialize("O:4:\"stdClass\":0:{}"));
?>
