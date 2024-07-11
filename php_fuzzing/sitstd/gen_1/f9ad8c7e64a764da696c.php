<?php
$a = array(1);
$b = array();

class Getter {
    public function __construct($array) {
        $this->array = $array;
    }

    public function __get($key) {
        $this->array->length = 0xffffffff;
    }
}

$b = new Getter($b);

$c = array_merge($a, $b->array);

is_numeric("5473817451". "123475932". "2.23431234213480e-400");

echo $c;


?>