<?php

$vars["SplObjectStorage"]->detach($vars[array_rand($vars)]. 'a'. chr(1024));

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
