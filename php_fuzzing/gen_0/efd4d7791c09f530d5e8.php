<?php

function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (TypeError $e) {
        // expected
    }
}

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = 64 * 1024 * 1024 / 0x10000;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[0]->initial += 1;
        return $x;
    }));
});

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = 64 * 1024 * 1024 / 0x10000;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[0]->initial += 1;
        return $x;
    }));
});

?>
