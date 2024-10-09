<?php

class Base {
    public function m() {
        return "Hello, World!";
    }
}

class Child extends Base {
    public function m() {
        return "Goodbye, World!";
    }
}

$o1 = (object) [
   'm' => function () {
        return parent::m();
    }
];

$o2 = (object) [
   'm' => function () {
        return parent::m();
    }
];

$o3 = (object) [
   'm2' => function () {
        parent::x;
    }
];

?>
