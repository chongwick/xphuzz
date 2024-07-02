<?php
<code>
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

function f($arg) {
    $o = new Proxy(new stdClass(), new stdClass());
    $o->foo = $arg;
}
f(0);

?>
</code>

?>