<?php

function gc() {
    for ($i = 0; $i < 20; $i++) {
        $arrayBuffer = array();
        for ($j = 0; $j < 100000; $j++) { 
            $arrayBuffer[] = null;
        }
    }
}

class Derived extends ArrayObject { 
    public function __construct($a = null) { 
        $a = 1;
    }
}

// Derived is not a subclass of RegExp
$o = new stdClass();
$o->lastIndex = 0x1234;

gc();

$vars["Directory"]->close(fopen("https://example.com/very/long/and/very/long/path/to/non/existent/file.txt", "rb"));

?>
