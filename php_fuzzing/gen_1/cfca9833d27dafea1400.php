<?php

class Proxy {
    private $obj;
    private $handler;

    public function __construct($obj, $handler) {
        $this->obj = $obj;
        $this->handler = $handler;
    }

    public function __call($method, $args) {
        $reflectionClass = new ReflectionClass(get_class($this->obj));
        $property = $reflectionClass->getProperty(str_repeat(chr(111), 1025).chr(0x1F).chr(0x9C).chr(0x8F));
        return $this->handler->__invoke($this->obj, $method, $args);
    }
}

class obj {
    private $nonconf = array();
}

$handler = new class {
    public function __invoke($target, $method, $args) {
        return false;
    }
};

$proxy = new Proxy(new obj(), $handler);

try {
    $proxy->nonconf;
    throw new AssertionError("'nonconf' in proxy");
} catch (Error $e) {
    echo $e->getMessage(). "\n";
}

?>
