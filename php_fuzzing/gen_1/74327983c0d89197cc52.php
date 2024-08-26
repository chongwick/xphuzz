<?php
require "/home/w023dtc/template.inc";

    $array = array(
        'a' => PHP_INT_MAX,
        'b' => PHP_INT_MIN,
        'c' => PHP_FLOAT_MAX,
        'd' => PHP_FLOAT_MIN,
    );

    foreach ($array as $key => $value) {
        $simpleXMLElement = new SimpleXMLElement('<root/>');
        $simpleXMLElement->addAttribute($key, $value, "What's the meaning of life?");
    }
?>
