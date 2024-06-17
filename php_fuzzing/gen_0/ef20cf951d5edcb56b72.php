<?php

function foo($arg) {
    $ret = array('x' => $arg);
    $ret['__set'] = function($obj, $name, $value) {
        // Do nothing
    };
    return $ret;
}

// v1 creates a map with a integer field, v2 deprecates v1's map.
$v1 = foo(10);
$v2 = foo(10.5);

// Trigger a set on v1, which also triggers an update to the array due to the different accessors on v1 and v2's y property.
$v1['x'] = 20.5;

?>
