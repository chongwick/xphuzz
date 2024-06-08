<?php

class C {
    public function bind() {
        // code to bind
    }
}

$obj = new C();
unset($obj->name);

$my_class = new \stdClass();
$my_class->__proto__ = $obj;

function foo($obj) {
    return $obj->bind();
}

echo foo($obj);

$obj[null] = new \Map();
gc();

echo foo($obj);

?>
