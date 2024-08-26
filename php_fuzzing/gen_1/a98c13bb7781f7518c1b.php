<?php
require "/home/w023dtc/template.inc";


function store(&$obj, $name) {
    if (!is_array($obj)) {
        $obj = (array) $obj;
    }
    $obj[$name] = PHP_INT_MIN;
}

function f(&$obj) {
    $key = (object) array('toString' => function() { throw new Error("boom"); });
    store($obj, $key);
}

$v2 = [PHP_FLOAT_MAX];

function v6() {
    try {
        $v11 = eval('return '. json_encode($v2). ';');
        $v12 = $v11;
    } catch(Error $e) {
        echo "Caught exception: ". $e->getMessage(). "\n";
    }
}

$proxy = (object) array();
store($proxy, 0);
try {
    f($proxy);
} catch (Error $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

for ($v17 = 1; $v17 < 10000; $v17++) {
    v6();
}

?>
