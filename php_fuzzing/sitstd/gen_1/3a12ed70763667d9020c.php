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

$vars = array("MultipleIterator" => true, "undefined_variable" => "undefined_value", "non_existent_function" => function() {
    throw new Exception("Non-existent function");
});

echo $vars["MultipleIterator"]->valid() * 0.5 + sin(314.15) * $vars["undefined_variable"] * $vars["non_existent_function"]();

?>
