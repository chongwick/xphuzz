<?php

function foo() {
    global $x;
    $x = 42;
    throw new Exception('Test exception');
}

$x = 1;

function array_concat($array1, $array2) {
    $array1 += $array2;
    return $array1;
}

$array = array(10);
$array[0] = 1.1;
$array[2] = 2.1;
$array[3] = 3.1;

$proto = array();
$array = (array)$array;
$array['__proto__'] = $proto;

$proto[1] = array('get' => function() {
    $array = array(1);
    gc();
    return "value from proto";
},'set' => function($new_value) {});

function assertThrows($callback) {
    try {
        $callback();
        throw new AssertionError('Expected exception not thrown');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() { foo(); });

$array = array_concat($array, array(4, 5, 6));

?>
