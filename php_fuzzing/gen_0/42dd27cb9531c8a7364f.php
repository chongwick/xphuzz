<?php
class MyClass {
    public $x = PHP_INT_MAX;
    public $y = PHP_INT_MIN;
    public $z = PHP_FLOAT_MAX;
    public $w = PHP_FLOAT_MIN;
}

$obj = new MyClass();

$vars = get_object_vars($obj);

var_dump($vars);

?>