<?php
require "/home/w023dtc/template.inc";


class MyRegExp {
    private $data = array(
        'x' => PHP_INT_MAX,
        'y' => PHP_FLOAT_MAX,
        PHP_INT_MAX => ''
    );

    public function exec($str) {
        $r = array();
        $r[0] = '0'; // Value could be changed to something arbitrary
        return $r;
    }

    public function __set($key, $value) {
        if (isset($this->data[$key])) {
            $this->data[$key] = $value;
        } else {
            throw new Exception('Cannot set property');
        }
    }

    public function __get($key) {
        return $this->data[$key];
    }
}

$myRegExp = new MyRegExp();
$b = new MyRegExp();

$b->x = PHP_INT_MAX;
$b->y = PHP_FLOAT_MAX;
$b->100000000000 = '';

// Trying to set a new property will trigger the exception
$b->z = 'test';

echo $b->x. "\n"; // Output: 2147483647
echo $b->y. "\n"; // Output: inf
echo $b->100000000000. "\n"; // Output: ''

?>
