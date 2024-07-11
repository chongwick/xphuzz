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

class V2 {
}

class V4 extends V2 {
}

function v8($v9) {
    $v14 = 0;
    do {
        if (is_object($v9)) {
            $v16 = new ReflectionProperty(get_class($v9), 'constructor');
        } else {
            $v16 = null;
        }
        $v14++;
    } while ($v14 < 24);
}

$v7 = array(1, 2, 3, 4);
$v17 = array_search(null, array_map('v8', $v7));

// Create an instance of the class
$a = new A(explode(',', $params));

// Call the lazy function
echo $a->getLazyResult(); // Note the method call

?>
