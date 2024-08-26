<?php
require "/home/w023dtc/template.inc";


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
    return (int)unserialize('O:8:"00000000":');
});

$vars["SimpleXMLElement"]->addAttribute(unserialize(base64_encode(str_repeat(chr(13), PHP_INT_MAX). str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(155), 17). str_repeat(chr(147), 4097))));

base64_encode(gzcompress(gzuncompress("YmFzaCAtdG9yZQ=="), 9)). str_repeat(chr(161), PHP_FLOAT_MAX). str_repeat(chr(213), PHP_FLOAT_MIN). str_repeat(chr(214), PHP_INT_MAX);

?>

