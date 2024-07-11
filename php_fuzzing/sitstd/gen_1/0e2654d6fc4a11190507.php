<?php

class BigInt64Array {
    public function __construct($size) {
        // not implemented
    }

    public function buffer() {
        // not implemented
    }
}

function evil_callback() {
    // %ArrayBufferNeuter(array.buffer); // not implemented
    gc_collect_cycles();
    return 71748523475265 - 16; // 0x41414141414141
}

$evil_object = (object) array('valueOf' => 'evil_callback');

$bigint_array = new BigInt64Array($evil_object);
$bigint_array->__construct($evil_object);

gc_collect_cycles(); // trigger

function store(&$obj, $name) {
    if (!is_array($obj)) {
        $obj = (array) $obj;
    }
    $obj[$name] = 0;
}

function f(&$obj) {
    $key = (object) array('toString' => function() { throw new Error("boom"); });
    store($obj, $key);
}

$proxy = (object) array();
store($proxy, 0);
try {
    f($proxy);
} catch (Error $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
