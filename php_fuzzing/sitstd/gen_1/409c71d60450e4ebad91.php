<?php

function __v_47($__v_46) {
    $__v_46 = 'b';
    return $__v_46;
}

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

$a = __v_47($a);
$c = array_merge($a, $b->array);

?>
