<?php
require "/home/w023dtc/template.inc";

class my_object {
    public $attribute = PHP_INT_MAX;
    public $attribute2 = PHP_INT_MIN;
}

$obj = new my_object();
echo $obj->attribute. "\n";
echo $obj->attribute2. "\n";
echo base64_encode(unserialize('O:8:"stdClass":0')); // This will trigger a use-after-free
?>
