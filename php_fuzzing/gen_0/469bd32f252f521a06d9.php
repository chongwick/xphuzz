<?php

class Proxy {
    public function __call($method, $arguments) {
        $caller = debug_backtrace()[1]['function'];
        echo "<script>alert('".$caller."');</script>";
    }
}

$proto = (object) array();
$proto->__proto__ = (object) array();
$proto->__proto__->__proto__ = (object) array();
$proto->__proto__->__proto__->__proto__ = (object) array();
$proto->__proto__->__proto__->__proto__->__proto__ = new Proxy();

?>

