<?php

class A {}
class B extends A {}

class WeakSet {
    private $data = array();

    public function add($value) {
        $this->data[$value] = null;
    }

    public function contains($value) {
        return array_key_exists($value, $this->data);
    }
}

$bar = function () {
    $foo = function ($x = new B()) {
        $weakSet = new WeakSet();
        $weakSet->add($x);
        if ($weakSet->contains($x)) {
            // $x is still reachable
        } else {
            // $x is no longer reachable
        }
    };
    $foo();
};
$bar();

?>
