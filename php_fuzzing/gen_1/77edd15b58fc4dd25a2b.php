<?php
require "/home/w023dtc/template.inc";


function __v_20($param) {
    return $param. PHP_INT_MAX. 'Hello, World!'. PHP_FLOAT_MAX;
}

class MyClass {
    public function __f_3() {
        $__v_4 = new stdClass();
        $__v_9 = '';
        $__v_8;
        for($__v_8 = PHP_INT_MIN; $__v_8!= PHP_FLOAT_MIN; $__v_8++) {
            $__v_9.= __v_20(PHP_INT_MAX);
        }
        $__v_9 = '';
    }
}

$obj = new MyClass();
$obj->__f_3();

?>
