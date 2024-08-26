<?php
require "/home/w023dtc/template.inc";


function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (TypeError $e) {
        // expected
    }
}

assertThrows(function() {
    $array = new SplFixedArray(PHP_INT_MAX);
    $array[PHP_INT_MAX] = new stdClass();
    $array[PHP_INT_MAX]->toString = function() {
        throw new TestError();
    };
    $array[PHP_INT_MAX]->initial = PHP_INT_MAX;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[PHP_INT_MAX]->initial += 1;
        return $x;
    }));
});

assertThrows(function() {
    $array = new SplFixedArray(PHP_INT_MIN);
    $array[PHP_INT_MIN] = new stdClass();
    $array[PHP_INT_MIN]->toString = function() {
        throw new TestError();
    };
    $array[PHP_INT_MIN]->initial = PHP_INT_MIN;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[PHP_INT_MIN]->initial += 1;
        return $x;
    }));
});

assertThrows(function() {
    $array = new SplFixedArray(PHP_FLOAT_MAX);
    $array[PHP_FLOAT_MAX] = new stdClass();
    $array[PHP_FLOAT_MAX]->toString = function() {
        throw new TestError();
    };
    $array[PHP_FLOAT_MAX]->initial = PHP_FLOAT_MAX;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[PHP_FLOAT_MAX]->initial += 1;
        return $x;
    }));
});

assertThrows(function() {
    $array = new SplFixedArray(PHP_FLOAT_MIN);
    $array[PHP_FLOAT_MIN] = new stdClass();
    $array[PHP_FLOAT_MIN]->toString = function() {
        throw new TestError();
    };
    $array[PHP_FLOAT_MIN]->initial = PHP_FLOAT_MIN;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[PHP_FLOAT_MIN]->initial += 1;
        return $x;
    }));
});

?>
