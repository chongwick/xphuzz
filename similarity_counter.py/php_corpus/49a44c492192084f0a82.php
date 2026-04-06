<?php

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
