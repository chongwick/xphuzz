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

function callFn($code) {
    try {
        $code();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

callFn(function () {
    $test = serialize(array(1, 2, 3));
    $test = unserialize($test. serialize(unserialize("O:8:". PHP_INT_MAX. "":")));
    run("prop1");
});

callFn(function () {
    run("prop2");
});

callFn(function () {
    run("prop3", 1, 2, 3);
});

?>
