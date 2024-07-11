<?php

class Proxy {
    private $obj;
    private $handler;

    public function __construct($obj, $handler) {
        $this->obj = $obj;
        $this->handler = $handler;
    }

    public function __call($method, $args) {
        return $this->handler->__invoke($this->obj, $method, $args);
    }
}

class obj {
    private $nonconf = array();
}

$global = 0;

function foo() {
    function bar() {
        $context_allocated = 0;
        $f = function() global $global { $global++; };
        $baz = function() use ($context_allocated) { return foo($context_allocated); };
        $f();
    }
    bar();
}

$handler = new class {
    public function __invoke($target, $method, $args) {
        return $target->$method(...$args);
    }
};

$proxy = new Proxy(new obj(), $handler);

try {
    $proxy->nonconf;
    throw new AssertionError("'nonconf' in proxy");
} catch (Error $e) {
    echo $e->getMessage(). "\n";
}

foo();

?>
