<?php
require "/home/w023dtc/template.inc";

class ArrayLike {
    private $num;
    public function __construct($num) {
        $this->num = $num;
    }
    public function __get($name) {
        if ($name == PHP_INT_MAX) {
            return str_repeat(chr(0x13), 257);
        }
        return null;
    }
    public function __set($name, $value) {
        // do nothing
    }
}
$arrayLike = new ArrayLike(PHP_INT_MIN);
$str = urldecode("%E7%9A%84");
echo "partial address of object num is ".ord($str[0])."\n";
echo "PHP_INT_MAX is ". PHP_INT_MAX. "\n";
echo "PHP_INT_MIN is ". PHP_INT_MIN. "\n";
echo "PHP_FLOAT_MAX is ". PHP_FLOAT_MAX. "\n";
echo "PHP_FLOAT_MIN is ". PHP_FLOAT_MIN. "\n";
?>

