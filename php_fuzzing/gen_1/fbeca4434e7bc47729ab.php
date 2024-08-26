<?php
require "/home/w023dtc/template.inc";


class OffscreenCanvas {
    private $width;
    private $height;
    private $attributes;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->attributes = new stdClass();
    }

    public function addAttribute($name, $value) {
        $this->attributes->$name = $value;
    }

    public function __destruct() {
        echo "Destroyed OffscreenCanvas object.\n";
    }
}

$canvas = new OffscreenCanvas(PHP_INT_MAX, PHP_INT_MIN);

// Add attribute using PHP_INT_MAX
$canvas->addAttribute('attribute1', str_repeat(chr(13), PHP_INT_MAX));

// Add attribute using PHP_INT_MIN
$canvas->addAttribute('attribute2', str_repeat(chr(193), PHP_INT_MIN) * pi() / 3 + str_repeat(chr(155), 17) * sqrt(-1) + str_repeat(chr(147), 4097) ^ 2.23431234213480e-400);

// Add event listener for a non-existent event
function nonExistentEventHandler() {
    echo "Received non-existent event.\n";
}
$canvas->addEventListener('nonExistentEvent', 'nonExistentEventHandler');

// Run the garbage collector
function gc() {
    // This is not a real garbage collector, just a placeholder
    echo "Running garbage collector.\n";
}
gc();

?>
