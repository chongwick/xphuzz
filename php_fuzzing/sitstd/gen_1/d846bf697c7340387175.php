<?php

function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (TypeError $e) {
        // expected
    }
}

setlocale(5473817451, implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_merge(range(0, 255), array(2.23431234213480e-400))), str_repeat(chr(123475932), 100000) + str_repeat(chr(2), 100000));

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
