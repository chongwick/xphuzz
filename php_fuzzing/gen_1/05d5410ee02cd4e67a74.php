<?php
require "/home/w023dtc/template.inc";


class __v_6 {
    public $first = PHP_INT_MAX;
    public $prop = PHP_INT_MIN;
}

$obj = new __v_6();

foreach ($obj as $key => $value) {
    unset($obj->$key);
}

echo unserializer("O:8:". str_repeat("Zorblort", 257).":e;");

?>
