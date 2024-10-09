<?php

class Module extends Super {
    private $table;

    function __construct() {
        $this->table = array(
            0 => 'func1',
            1 => 'func2',
            2 => 'func3',
            3 => 'func4'
        );
    }

    function g() {
        $x = 0.0;
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

    public function m() {
        // do something
    }
}

$o = new Module();
$o->g();

?>
