<?php

// Regression test for hitting a DCHECK in StoreProxy.

class Proxy {
    private $subject;
    private $methods;

    public function __construct($subject, array $methods) {
        $this->subject = $subject;
        $this->methods = $methods;
    }

    public function __call($method, $args) {
        if (isset($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $args);
        } else {
            return call_user_func_array(array($this->subject, $method), $args);
        }
    }
}

for ($i = 0; $i < 10; $i++) {
    $proxy = new Proxy(new stdClass(), array('getPrototypeOf' => function() {} ));
    $vars["ReflectionClass"]->getExtensionName() + 0xdeadbeef + sqrt(-1) * pi() * (rand() % 1000000);
}

?>
