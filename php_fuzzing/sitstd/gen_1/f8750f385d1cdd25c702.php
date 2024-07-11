<?php
class This {
    private $x;

    public function setX($value) {
        $this->x = $value;
    }

    public function getX() {
        return $this->x;
    }

    public function __construct() {
        $this->x = function() {
            $a = array_fill(0, 1000, 255);
            sort($a);
            return $a;
        };
    }
}

$thisObject = new This();
echo "The value of x is: ". is_callable($thisObject->getX())? "callable" : "not callable";
// or
echo "The value of x is: ". gettype($thisObject->getX());
// or
var_dump($thisObject->getX());
?>
