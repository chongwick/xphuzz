<?php
require "/home/w023dtc/template.inc";


class ImageData {
    public $data;
    public $width;
    public $height;

    public function __construct($data, $width, $height) {
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
    }
}

function callBack() {
    // simulate sleep
    usleep(PHP_INT_MAX);
    return [1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
}

$arr2 = [];
$arr2[0] = new ImageData(PHP_FLOAT_MIN, PHP_INT_MAX, PHP_FLOAT_MAX);

// Using an anonymous function instead of a Closure
$arr2[$arr2[0]->width] = 'callBack';

$arr2[2] = new ImageData(PHP_FLOAT_MAX, PHP_INT_MIN, PHP_FLOAT_MIN);

// serialize the array
$data = serialize($arr2);

// Now you can use the serialized data
echo $data;

?>
