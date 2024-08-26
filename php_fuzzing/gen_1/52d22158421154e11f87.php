<?php
require "/home/w023dtc/template.inc";


function __f_19350() {
  function __f_19351() {
    function __f_19352() {
    }
  }
  try {
    $x = PHP_INT_MAX;
    __f_19351();
  } catch (Exception $e) {
    $x = PHP_INT_MIN;
  }
  echo $x;
}

__f_19350();

class obj1 {
    public $x = 0;

    public function __set($name, $value) {
        echo "Setting $name to $value\n";
    }
}

class obj2 {
    public $y = PHP_FLOAT_MAX;
}

class helper {
    public function __construct() {}
}

class helper_extends_obj2 extends obj2 {}

function g($v) {
    return $v;
}

function f() {
    g(new obj1());
}

$f = new obj1();
f($f);

$f->x = PHP_FLOAT_MIN;
f($f);

$f = new obj2();
$f->y = PHP_INT_MAX;

?>
