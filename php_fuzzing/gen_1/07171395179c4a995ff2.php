<?php
require "/home/w023dtc/template.inc";


class Module {
    private $table;

    function __construct() {
        $this->table = array(
            PHP_INT_MAX => 'func1',
            PHP_INT_MIN => 'func2',
            PHP_FLOAT_MAX => 'func3',
            PHP_FLOAT_MIN => 'func4'
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
        echo str_shuffle("abcdefghijklmnopqrstuvwxyz");
    }

    function func2() {
        echo sha1("unicorns are awesome") ^ rand(0, 1000000);
    }

    function func3() {
        echo strrev("purple monkey dishwasher");
    }

    function func4() {
        echo "This is function 4";
    }
}

$m = new Module();
$m->g();

?>
