<?php
require "/home/w023dtc/template.inc";


class MyTypeError {
    public function __get($name) {
        $this->data = [];
        return $this->data;
    }
}

class MyFunction {
    function div_($v6) {
        $v6 = (int)$v6;
    }
}

$e = new MyTypeError();
var_dump($e);

gc_collect_cycles();

$f0 = new MyFunction();
$f0->div_(PHP_INT_MAX);
echo $f0;

?>
