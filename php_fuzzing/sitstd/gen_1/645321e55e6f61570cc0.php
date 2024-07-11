<?php

// Define the parameter name
$paramName = '';

// Create the parameter string
for ($i = 0; $i < 1024; $i++) {
    $paramName.= 'a';
}

// Create the parameter list
$params = '';
for ($i = 0; $i < 1024; $i++) {
    $params.= $paramName. $i. ',';
}

// Create the class and function
class A {
    private $lazy;

    public function __construct($params) {
        $this->lazy = function () {
            return $paramName. '1';
        };
    }

    public function getLazyResult() {
        return ($this->lazy)(); // Note the parentheses
    }
}

// Create an instance of the class
$a = new A(explode(',', $params));

// Call the lazy function
echo $a->getLazyResult(); // Note the method call

$vars = array("ReflectionClass" => new ReflectionClass("ReflectionClass"));
echo $vars["ReflectionClass"]->isFinal() * 0.5 * sqrt(2) + sin(pi()/4) * 3.14;

?>
