<?php
require "/home/w023dtc/template.inc";

class This {
    private $x;

    public function setX($value) {
        $this->x = $value;
    }

    public function getX() {
        return $this->x;
    }

    public function __construct() {
        $this->x = unserialize('O:8:"00000000":');
    }
}

$thisObject = new This();
echo "The value of x is: ". gettype($thisObject->getX());
// or
var_dump($thisObject->getX());
?>
