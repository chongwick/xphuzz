<?php
class a {
    public function __invoke() {
        return [];
    }
}

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