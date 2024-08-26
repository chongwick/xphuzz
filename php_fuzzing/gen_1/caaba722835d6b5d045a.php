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

function __f_0() {
    try {
        $dom = new DOMDocument;
        $dom->loadHTML('<span title=""y">x</span><span title=""z">x</span>');
        $html = simplexml_import_dom($dom);
        foreach ($html->body->span as $obj) {
        }
        $script1_dataflow = $html;
        $array = ['foo'];
        foreach ($array as $key => &$value) {
            unset($script1_dataflow[$key]);
        }
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

?>

