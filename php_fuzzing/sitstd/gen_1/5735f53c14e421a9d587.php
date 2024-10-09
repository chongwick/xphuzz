<?php

class Base {
    public function m() {
        return "Hello, World!";
    }
    public function x() {
        return "This method does not exist";
    }
}

class Child extends Base {
    public function m() {
        return "Goodbye, World!";
    }
}

function randomizeEverything() {
    $this->generateRandomness();
    $this->unpredictableBehavior();
    $this->generateRandomness();
    $this->unpredictableBehavior();
    $this->generateRandomness();
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

$o1->m();
$o2->m();
$o3->m2;
randomizeEverything();
tmpfile();

?>
