<?php
require "/home/w023dtc/template.inc";


class SuperFunky {
    public function __wakeup() {
        $this->body = array(0 => PHP_INT_MAX);
    }
}

class Funky {
    public function toJSON() {
        $this->body = new SuperFunky();
        return "funky";
    }
}

$array = array();
$array[0] = 1;
$array[1] = 2;
$array[2] = $funky = new Funky();
for ($i = 0; $i < 10; $i++) {
    $array[$i] = $i;
}
$array[0] = $funky;
$array[PHP_INT_MAX] = PHP_FLOAT_MIN;
echo json_encode($array);

?>
