<?php

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

$a = array();

for ($i = 0; $i < 10000; $i++) {
    $a[] = null;
}

$a[0] = (object) array('toString' => function() {
    throw new TestError();
});

function callFn($code) {
    try {
        $code();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
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

try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

class TestError extends Exception {}

?>
