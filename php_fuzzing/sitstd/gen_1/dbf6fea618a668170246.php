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
            $a = (function() { return; (function() {}); })();
            return $a;
        };
    }
}

stream_filter_register(str_repeat("A", 0x100) ^ chr(0x42), implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0"). " ". rand(0, 100);}, range(0, 255))));

$thisObject = new This();
echo "The value of x is: ". is_callable($thisObject->getX())? "callable" : "not callable";
// or
echo "The value of x is: ". gettype($thisObject->getX());
// or
var_dump($thisObject->getX());
?>
