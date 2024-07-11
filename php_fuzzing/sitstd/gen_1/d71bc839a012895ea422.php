<?php

class Get {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get, $get1, $get2) {
            return $get;
        };
    }
}

class Get1 {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get,...$args) {
            // $args is an array of arguments
            // you can access them like this: $args[0], $args[1],...
        };
    }
}

function f1() {}
function f2() {}

$o1 = array();
$o1['a'] = 0;
$o1['f'] = 'f1';

$o2 = array();
$o2['a'] = 4.2;
$o2['f'] = 'f2';

echo $o1['a'];

$g = new Get();
$g1 = new Get1();

?>
