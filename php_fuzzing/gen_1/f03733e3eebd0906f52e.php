<?php
require "/home/w023dtc/template.inc";


function executeCode($code) {
    if (is_callable($code)) {
        $code();
    }
}

function __getObjects($root = null, $level = 0) {
    if ($root === null) {
        $root = (object)array(); // Create a new stdClass
    }
    $obj_names = array();
    foreach (get_object_vars($root) as $name => $value) {
        $obj_names[] = $name;
    }
    $objects = array();
    for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
        foreach ($obj_names as $obj_name) {
            $objects[$i][] = $root->$obj_name;
        }
    }
    return $objects;
}

function __getRandomObject() {
    $objects = __getObjects();
    foreach ($objects as $i => $values) {
        if (count($values) > 0) {
            return $values[0];
        }
    }
    return null;
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

$serialized = serialize($v33);
unserialize($serialized);

?>
