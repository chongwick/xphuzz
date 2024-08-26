<?php
require "/home/w023dtc/template.inc";


function serialize_array($data) {
    return serialize(array_map(function($x) {
        return unserialize($x);
    }, $data));
}

function run() {
    return unserialize("O:8:". str_repeat("0", PHP_INT_MAX). ":");
}

function test() {
    echo run();
}

function main() {
    $data = [];
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $data[] = serialize_array(array_fill(0, 1000000, "x"));
    }
    test();
}

main();

?>
