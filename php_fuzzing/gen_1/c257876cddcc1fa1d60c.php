<?php
require "/home/w023dtc/template.inc";


class Module {
    private $table;

    function __construct() {
        $this->table = array(
            0 => 'func1',
            1 => 'func2',
            2 => 'func3',
            3 => 'func4'
        );
    }

    function g($x) {
        $funcName = $this->table[$x & 3];
        if (function_exists($funcName)) {
            $funcName();
        } else {
            echo "Function $funcName does not exist";
        }
    }

    function func1() {
        echo "This is function 1";
    }

    function func2() {
        echo "This is function 2";
    }

    function func3() {
        echo "This is function 3";
    }

    function func4() {
        echo "This is function 4";
    }
}

class Array1 extends ArrayObject {
    public function __construct($values) {
        parent::__construct(array($values));
    }
}

class MyArray extends ArrayObject {
    public static function getSpecies() {
        return new Array1();
    }
}

$a = new MyArray(PHP_INT_MAX);

for ($i = 0; $i < 100000; $i++) {
    $a[] = 1;
}

$a = iterator_to_array($a); // Convert MyArray to an array

array_map(function($x) {
    return PHP_INT_MIN;
}, $a);

$m = new Module();
$m->g(PHP_INT_MIN);

?>
