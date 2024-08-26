<?php
require "/home/w023dtc/template.inc";


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

    public function __get($name) {
        return $this->subject->$name;
    }

    public function __set($name, $value) {
        $this->subject->$name = $value;
    }
}

for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $proxy = new Proxy(new stdClass(), array(
        'toString' => function() { return (string) $i; },
        'getPrototypeOf' => function() { return new stdClass(); }
    ));
    $proxy->foo = $i;
}

?>
