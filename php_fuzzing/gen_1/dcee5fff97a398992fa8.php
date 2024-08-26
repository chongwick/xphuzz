<?php
require "/home/w023dtc/template.inc";

class MyTypeError {
    public function __get($name) {
        $this->data = [];
        return $this->data;
    }
}

class MyFloat {
    public $data;
}

$f = new MyFloat();
$f->data = PHP_INT_MAX;

$e = new MyTypeError();
var_dump($e->data = $f->data);

gc_collect_cycles();

?>
