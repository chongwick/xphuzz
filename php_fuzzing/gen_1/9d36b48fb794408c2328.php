<?php
require "/home/w023dtc/template.inc";


define('kWasmI32', 0);
define('kWasmF32', 1);
define('kExprI32Const', 0);
define('kExprF32Const', 1);
define('kExprI32Sub', 2);
define('kExprF32Eq', 3);
define('kExprI32LoadMem', 4);
define('kExprI32Add', 5);
define('kExprIf', 6);
define('kExprEnd', 7);
define('kTrapMemOutOfBounds', 0);

class HeapObjectVerify {
    public static function verify($obj) {
        // Implement the verification logic here
    }
}

class MyObject {
    public $x = PHP_INT_MAX;
    public $y = PHP_INT_MIN;
    public $z = PHP_FLOAT_MAX;
    public $w = PHP_FLOAT_MIN;
}

$obj = new MyObject();
$obj->{"__toStringTag"} = 'foo';
$obj->{"__hasInstance"} = function() { return true; };
$obj->{"__isConcatSpreadable"} = true;

$obj2 = (object) array_merge((array) $obj, []);

HeapObjectVerify::verify($obj2);

// Ensure correct result for some well-known symbols
echo "[object ". get_class($obj2). "]\n";
var_dump(is_subclass_of('stdClass', get_class($obj2)));
var_dump( array_values( array_merge([], (array) $obj2) ) );

// Trigger the vulnerability
while (true) {
    $obj3 = new MyObject();
    $obj3->{"__proto__"} = $obj2;
}

?>
