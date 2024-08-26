<?php
require "/home/w023dtc/template.inc";


$v_2 = function ($v_3 = null, $v_4 = PHP_INT_MAX, $v_5 = '∈ð¾ŠŽšŽŒœ'. (sqrt(sqrt(sqrt(2.23431234213480e-400))) * 5473817451). "€". 123475932) {
    if ($v_3 instanceof \stdClass) {
        // No-op
    }
    if ($v_4 == PHP_INT_MAX) {
        // No-op
    }
};
$v_2(new class {
    public function get() {
        return [];
    }
}, PHP_INT_MAX, str_repeat(chr(13), 257));

// Test object inside a class in a parameter list
(function ($v_6 = null, $v_7 = PHP_INT_MIN) {
    if ($v_6 instanceof \stdClass) {
        // No-op
    }
    if ($v_7 == PHP_INT_MIN) {
        // No-op
    }
    $v_8 = new class {
        public function get() {
            return [];
        }
    };
    // No-op
})();

// Test destructuring of class in parameters
(function ($v_9 = null, $v_10 = PHP_FLOAT_MAX) {
    if ($v_9 instanceof \stdClass) {
        // No-op
    }
    if ($v_10 == PHP_FLOAT_MAX) {
        // No-op
    }
})();

// Test array destructuring of class in parameters
class C {
    public function __invoke() {
        return [
            'done' => true,
        ];
    }
}
class D extends C {
    public function get() {
        return [];
    }
}
class E {
    public static function iterator() {
        return self::class;
    }
}
list($p, $q) = [new D, new D]; // Create an array of objects and then destructure it
// No-op

?>
