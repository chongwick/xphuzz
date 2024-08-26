<?php
require "/home/w023dtc/template.inc";


function f(array $array, $x) {
    $array['x'] = $x;
    $array[0] = null;
    return $array;
}

class Get {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get, $get1, $get2) {
            return $get;
        };
    }

    public function f(array $array, $x) {
        $array['x'] = $x;
        $array[0] = null;
        return $array;
    }
}

$a = new Get();
$b = array($a, PHP_INT_MAX);
$c = $a->f($b, PHP_INT_MIN);
var_dump($c);

?>
