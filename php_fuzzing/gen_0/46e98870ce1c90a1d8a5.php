<?php

function f1() {
    return $this;
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
    $a['x'] = 0;
    if ($a['x'] === 0) {
        $a[1] = 0.1;
    }
    echo f2(new C(), array(),'string');
}

$a = array(1);
f3($a);
f3($a);
f3($a);

?>
