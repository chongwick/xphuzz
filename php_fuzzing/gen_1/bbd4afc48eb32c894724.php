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
    public $nonconf = array();
}

$handler = new class {
    public function __invoke($target, $method, $args) {
        if ($method === 'nonconf') {
            return null;
        }
        return false;
    }
};

$proxy = new Proxy(new obj(), $handler);

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $proxy->nonconf[PHP_INT_MIN][$i] = PHP_FLOAT_MAX;
}

echo var_dump($proxy->nonconf[PHP_INT_MIN][PHP_INT_MAX]);

?>
