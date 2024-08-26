<?php
require "/home/w023dtc/template.inc";


class Overflow {
    private $integer = PHP_INT_MAX;
    private $float = PHP_FLOAT_MAX;
    private $str = str_repeat("a", PHP_INT_MAX);
    private $obj = (object)[];
    private $arr = array_fill(0, PHP_INT_MAX, 1);

    public function __wakeup() {
        $this->integer++;
        $this->float++;
        $this->str.= 'a';
        $this->obj->foo = 1;
        $this->arr[PHP_INT_MAX - 1]++;
    }

}

?>
