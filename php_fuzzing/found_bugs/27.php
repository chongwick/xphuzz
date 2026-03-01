<?php

class ArrayLike {
    private $num;
    public function __construct($num) {
        $this->num = $num;
    }
    public function __get($name) {
        if ($name == 0) {
            return PHP_INT_MAX;
        } elseif ($name == 1) {
            return PHP_INT_MIN;
        } elseif ($name == 2) {
            return PHP_FLOAT_MAX;
        } elseif ($name == 3) {
            return PHP_FLOAT_MIN;
        }
        return null;
    }
}

$arrayLike = new ArrayLike(0);
$arrayLike->{(int)PHP_INT_MAX};

$date = mktime($arrayLike->{(int)PHP_INT_MAX}, $arrayLike->{(int)PHP_INT_MIN}, $arrayLike->{(int)PHP_FLOAT_MAX}, PHP_INT_MIN, PHP_INT_MIN, PHP_INT_MIN);
$result = checkdate(2, 3, $date);
return $result;

echo $result;

?>
