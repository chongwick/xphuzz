<?php
$str2 = chr(44); // add `,` into single character string
$o2 = array_fill(0, 10000, ''); // equivalent to new Array(0x20000000)
array_walk($o2, function(&$v) { $v = ''; }); // equivalent to String.prototype.split.call(o2,'');

function gc() {
    for ($i = 0; $i < 20; $i++) {
        $a = new \stdClass();
    }
}

class Derived extends \ArrayObject {
    public function __construct($a) {
        $this->a = 1;
    }
}

// Derived is not a subclass of \stdClass
$o = new \stdClass();
$o->lastIndex = 0x1234;

gc();

$str = implode('', $o2);
echo $str. $str2. json_encode($o). "\n";
?>
