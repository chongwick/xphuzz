<?php
class MangledObject {
    public $a = PHP_INT_MAX;
    public $b = PHP_INT_MIN;
    public $c = PHP_FLOAT_MAX;
    public $d = PHP_FLOAT_MIN;
}

$obj = new MangledObject();
var_dump(get_mangled_object_vars($obj));

?>