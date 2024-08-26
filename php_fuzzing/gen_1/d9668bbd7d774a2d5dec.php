<?php
require "/home/w023dtc/template.inc";


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
    private $nonconf = PHP_INT_MAX;
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

$obj = new SimpleXMLElement();
$obj->addAttribute(str_repeat(microtime(), 257), PHP_INT_MIN, PHP_FLOAT_MIN);

var_dump($obj);

?>
