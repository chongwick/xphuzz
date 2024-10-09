<?php

class Buffer {
    public $buffer;

    public function grow($array) {
        // implement your logic here
        return $array;
    }
}

function baz($x) {
    return array('f' => function() {});
}

function foo($x) {
    $buffer = new Buffer();
    $buffer->buffer = baz($x);
    return call_user_func_array(array($buffer, 'grow'), array($buffer->buffer));
}

$v10 = foo('Hello'); // Passing an argument to foo()
$v15 = foo('World'); // Passing an argument to foo()
$v16 = foo('PHP'); // Passing an argument to foo()

?>
