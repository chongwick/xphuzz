<?php
require "/home/w023dtc/template.inc";

$a = array(1);
$b = array();

class Getter {
    public function __construct($array) {
        $this->array = $array;
    }

    public function __get($key) {
        $this->array->length = PHP_INT_MAX;
    }
}

$b = new Getter($b);

$c = array_merge($a, $b->array);

$serialized_string = serialize($c);

echo $serialized_string. " O:". PHP_INT_MAX. ":";

?>
