<?php
class OffscreenCanvas {
    private $width;
    private $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function addEventListener($event, $handler) {
        // No equivalent in PHP, this event is specific to webgl context
        echo "Added event listener for $event event.\n";
    }
}

$canvas = new OffscreenCanvas(10, 10);

// Add event listener for webglcontextlost event
function webglcontextlostHandler() {
    // No equivalent in PHP, this event is specific to webgl context
}
$canvas->addEventListener('webglcontextlost', 'webglcontextlostHandler');

// gc() function is not a native PHP function, so we'll create a simple wrapper function
function gc() {
    // No equivalent in PHP, gc() is a JavaScript function that runs the garbage collector
}
gc();
gc();
?>
