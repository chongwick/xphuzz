<?php
require "/home/w023dtc/template.inc";


function f1() {
    return PHP_INT_MAX;
}

function f2($x, $value, $type) {
    return $x instanceof $type;
}

class B {
    public static function foo() {
        return 'f1';
    }
}

class C extends B {
    function bar() {
        return parent::foo();
    }
}

function f3($a) {
    $a['x'] = PHP_INT_MAX;
    if ($a['x'] === PHP_INT_MAX) {
        $a[1] = PHP_FLOAT_MAX;
    }
    echo f2(new C(), array(),'string');
}

$a = array(1);
f3($a);
f3($a);
f3($a);

class D {
    public function __construct($var) {
        $this->$var = $var;
    }
}

$D = new D('x');
$D->$x = 'hello';
echo $D->$x;

unserialize('O:8:"00000000":');

?>
