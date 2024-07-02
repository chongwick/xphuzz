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

function Module() {
    function f() {}
    return ['f' => 'f'];
}

function InstantiateNearStackLimit() {
    $fuse = 0;
    try {
        return $fuse - 1;
    } catch (Exception $e) {
        return 0;
    }
}

$init_fuse = 0;
for ($init_fuse = 0; $init_fuse < 10; $init_fuse++) {
    $fuse = InstantiateNearStackLimit();
}

gc();

$o = new stdClass();
$o->lastIndex = 0x1234;

Derived::getInstance();

?>
