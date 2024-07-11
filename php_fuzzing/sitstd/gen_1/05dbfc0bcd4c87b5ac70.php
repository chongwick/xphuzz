<?php

class a {
    public function __invoke() {
        return [];
    }
}

function __f_4622() {
    $__v_22507 = array();
}

__f_4622();

class b {
    public function __invoke() {
        return [];
    }
}

class c {
    // no implementation needed for this example
}

function foo() {
    return (new a())->__invoke();
}

foo();

?>
