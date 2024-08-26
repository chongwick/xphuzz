<?php
require "/home/w023dtc/template.inc";


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

class C {
    use T;
    private $xw = new XMLWriter();
    private $xw->openMemory();
    private $xw->startDocument(NULL, "UTF-8");
    private $xw->endDocument();
}

callFn(function () {
    run("construct", []);
});

callFn(function () {
    run("prop1", PHP_INT_MAX, PHP_INT_MIN);
});

callFn(function () {
    run("prop2", PHP_FLOAT_MAX, PHP_FLOAT_MIN);
});

function callFn($code) {
    try {
        $code();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
