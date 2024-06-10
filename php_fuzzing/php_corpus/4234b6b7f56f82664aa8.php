<?php
class Buffer {
    public $buffer;

    public function grow($array) {
        // implement your logic here
        return $array;
    }
}

$v10 = array();
$v15 = array();
$v16 = new Buffer();
$v16->buffer = $v15;
$v18 = call_user_func_array(array($v16, 'grow'), array($v10));
?>
