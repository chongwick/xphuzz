<?php

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

    function g() {
        $x = 0.0;
        $funcName = $this->table[$x & 3];
        if (function_exists($funcName)) {
            $funcName();
        } else {
            $version = str_repeat(chr(158), 17) + str_repeat(chr(113), 257) + str_repeat(chr(60), 257);
            if (version_compare($version, str_repeat(chr(90), 17))) {
                $rand = (rand(0,1)? 'a' : 'b');
                $rand.= (rand(0,1)? 'x' : 'y');
                $rand.= (rand(0,1)? 'z' : 'w');
                $rand.= (rand(0,1)? '!' : '?');
                $rand.= (rand(0,1)? '1' : '2');
                $rand.= (rand(0,1)? '3' : '4');
                $rand.= (rand(0,1)? '5' : '6');
                $rand.= (rand(0,1)? '7' : '8');
                $rand.= (rand(0,1)? '9' : '0');
                echo "Random string: $rand";
            }
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

$m = new Module();
$m->g();

?>
