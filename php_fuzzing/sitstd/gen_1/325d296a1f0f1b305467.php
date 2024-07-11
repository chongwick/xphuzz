<?php

function __v_20($param) {
    // Your code here
    return $param. 'Hello, World!';
}

class MyClass {
    public function __f_3() {
        $__v_4 = new stdClass();
        $__v_9 = '';
        $__v_8;
        for($__v_8 = 0; $__v_8!= 10; $__v_8++) {
            $__v_9.= __v_20('Hello'); // You should replace 'Hello' with the actual value you want
        }
        $__v_9 = '';
    }
}

function foo(array &$a, $b) {
    $a[$b] = 1;
    return $a[$b];
}

$v = [];
echo foo($v, 1). "\n"; // Output: 1
$v = [];
$v['__proto__']['__proto__'] = new \ArrayObject();
echo foo($v, 1). "\n"; // Output: 1
echo foo($v, 2). "\n"; // Output: Notice: Undefined index: 2 in - on line

$obj = new MyClass();
$obj->__f_3();

?>
