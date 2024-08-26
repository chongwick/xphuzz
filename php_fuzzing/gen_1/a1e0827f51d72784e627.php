<?php
require "/home/w023dtc/template.inc";


// Create a large string
$string = str_repeat(chr(255), PHP_INT_MAX);

// Define the parameter name
$paramName = '';

// Create the parameter string
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $paramName.= 'a';
}

// Create the parameter list
$params = '';
for ($i = 0; $i < PHP_INT_MAX; $i++) {
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

// Create a large array
$array = array_fill(0, PHP_INT_MAX, $string);

// Use the array in a closure
$closure = function ($array) {
    return $array[PHP_INT_MAX];
};

echo $closure($array); // Note the array access

?>
