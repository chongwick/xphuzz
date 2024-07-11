<?php

function executeCode($code) {
    if (is_callable($code)) {
        $code();
    }
}

function assertThrows($code) {
    executeCode($code);
}

function __isPropertyOfType($obj, $name) {
    // This function is not used in the given code, so it can be removed.
}

function __getProperties($obj) {
    $properties = array();
    foreach (get_object_vars($obj) as $name => $value) {
        $properties[] = $name;
    }
    return $properties;
}

function __getObjects($root = null, $level = 0) {
    if ($root === null) {
        $root = (object)array(); // Create a new stdClass
    }
    $obj_names = __getProperties($root);
    foreach ($obj_names as $obj_name) {
        yield from __getObjects($root->$obj_name, $level + 1);
    }
}

function __getRandomObject() {
    foreach (__getObjects() as $obj) {
        // This function is not used in the given code, so it can be removed.
    }
}

function __f_0() {
    try {
        __getRandomObject();
    } catch (Exception $e) {}
}

__f_0();

$v32 = "ff";
$v33 = "0x";

try {
    for ($v34 = 2; $v34 < 10; $v34++) {
        $v32.= $v32;
        $v33.= $v32;
        if (strlen($v32) > 1000000) {
            break;
        }
    }
} catch (Exception $e) {}

assertThrows(function() {
    return (int)$v33;
});

$vars = array();
$vars["SplQueue"]->setIteratorMode(0.5);

?>
