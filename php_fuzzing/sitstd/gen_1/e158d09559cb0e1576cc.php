<?php

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
    usleep(2000000);
    return [1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
}

$arr2 = [];
$arr2[0] = new ImageData(0x1ffff, 0x1000, 0x1000);

// Using an anonymous function instead of a Closure
$arr2[$arr2[0]->width] = 'callBack';

$arr2[2] = new ImageData(0x1ffff, 0x1000, 0x1000);

// serialize the array
$data = serialize($arr2);

// Now you can use the serialized data
echo $data;

$vars["SplDoublyLinkedList"]->rewind(5473817451, 123475932, 2.23431234213480e-400);

?>
