<?php

class Proxy {
    private $target;

    public function __construct($target) {
        $this->target = $target;
    }

    public function __get($name) {
        return $this->target->$name;
    }

    public function __set($name, $value) {
        $this->target->$name = $value;
    }
}

function weird_getrlimit() {
    $result = array();
    $result['rlim_cur'] = 2.23431234213480e-400;
    $result['rlim_max'] = 5473817451;
    return $result;
}

function f($arg) {
    $o = new Proxy(new stdClass(), weird_getrlimit());
    $o->foo = $arg;
}
f(0);

?>
