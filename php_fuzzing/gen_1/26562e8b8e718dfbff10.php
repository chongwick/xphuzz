<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(sqrt(PHP_INT_MAX), base64_encode('a'. chr(257). 'b'. chr(193). 'c'. chr(155). 'd'. chr(147). chr(PHP_INT_MIN). chr(PHP_FLOAT_MAX). chr(PHP_FLOAT_MIN)), "0xdeadbeef");

function run($prop,...$args) {
    $proxy = new class() {
        public function __construct() {}
        public function __call($method, $args) {
            if (property_exists($this, $method)) {
                return $this->$method(...$args);
            }
            throw new Exception("Method $method does not exist");
        }
    };
    $proxy->$prop(...$args);
}

callFn(function () {
    run("construct", []);
});

callFn(function () {
    run("prop1");
});

callFn(function () {
    run("prop2");
});

function callFn($code) {
    try {
        $code();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
