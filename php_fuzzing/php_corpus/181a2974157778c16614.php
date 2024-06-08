<?php
class Rectangle {
    private $height;
    private $width;

    public function __construct($height, $width) {
        $this->height = $height;
        $this->width = $width;
    }

    public function getArea() {
        return $this->calcArea();
    }

    public function calcArea() {
        return $this->height * $this->width;
    }
}

$rectangle = new Rectangle(10, 20);

function add($a, $b) {
    echo "add($a, $b)\n";
}

while (true) {
    try {
        add(1, 2);
    } catch (Exception $e) {
        echo $e->getMessage(). "\n";
    }
}

?>
