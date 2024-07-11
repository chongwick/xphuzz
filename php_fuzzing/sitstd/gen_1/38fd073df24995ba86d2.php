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

hash_equals(implode(array_map(function($c) {
    $c = $c ^ 0x42;
    return "\\x". str_pad(dechex($c), 2, "0");
}, array_merge(range(0, 255), array_fill(256, 16, 0x80))), str_repeat("A", 0x100 ^ 0x42));

?>
