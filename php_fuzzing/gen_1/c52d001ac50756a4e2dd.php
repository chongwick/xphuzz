<?php
require "/home/w023dtc/template.inc";


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

$vars["SimpleXMLElement"]->addAttribute(str_split(base64_encode(sha1(time().rand())))[PHP_INT_MAX], str_split(base64_encode(hash('crc32', 'randomstring', TRUE)))[PHP_INT_MAX] + str_split(base64_encode(sha1(microtime())))[PHP_FLOAT_MAX] + str_split(base64_encode(sha1(random_bytes(PHP_INT_MAX)))), str_split(base64_encode(hash('md5', 'randomstring2', TRUE)))[PHP_INT_MIN] + str_split(base64_encode(sha1(str_repeat(chr(32), PHP_INT_MAX))))[PHP_INT_MAX] + str_split(base64_encode(sha1(str_repeat(chr(33), PHP_INT_MAX))))[PHP_INT_MAX]);

?>
