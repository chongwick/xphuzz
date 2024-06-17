<?php

class MyTypeError {
    public function __get($name) {
        $this->data = [];
        return $this->data;
    }
}

$e = new MyTypeError();
var_dump($e);

gc_collect_cycles();

?>
