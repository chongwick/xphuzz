<?php
require "/home/w023dtc/template.inc";

$b = new SplObjectStorage();
array_map(function() use (&$b) {
    $object = new stdClass();
    $object->a = str_repeat("a", 2);
    $b->attach($object);
}, range(10000, 0));

?>