<?php

// Tests if class declarations in parameter list are correctly handled.
$v_2 = function ($v_3 = null) {
    if ($v_3 instanceof \stdClass) {
        // No-op
    }
};
$v_2(new class {
    public function get() {
        return [];
    }
});

// Test object inside a class in a parameter list
(function () {
    $v_3 = new class {
        public function get() {
            return [];
        }
    };
    // No-op
})();

// Test destructuring of class in parameters
(function ($params = null) {
    if ($params instanceof \stdClass) {
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

