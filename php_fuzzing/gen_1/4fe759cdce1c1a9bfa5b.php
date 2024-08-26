<?php
require "/home/w023dtc/template.inc";


$propName = "WebCore::HiddenProperty::listener";
$obj = array();

class MyObject {
    public function __set($name, $value) {
        if ($name == $propName) {
            unset($this->$propName);
            $this->hiddenObj = $this;
            $this->att = PHP_INT_MAX;
        }
    }
}

$obj = new MyObject();

function addEvent($event, $obj) {
    // Add event logic here
    echo "Added event $event for object\n";
}

function removeEvent($event, $obj) {
    // Remove event logic here
    echo "Removed event $event for object\n";
}

addEvent('message', $obj);

$obj->$propName = str_repeat(chr(8203), 257). chr(0x200D). chr(0x200E). chr(0x10FFFF). chr(0xD800). chr(0xDFFF). chr(0xDC00). chr(0xDFFF). chr(0xDC01). chr(0xDFFF). chr(0xDC03). chr(0xDFFF). chr(0xDC04). chr(0xDFFF). chr(0xDC05);

removeEvent('message', $obj);

var_dump($obj);

?>
