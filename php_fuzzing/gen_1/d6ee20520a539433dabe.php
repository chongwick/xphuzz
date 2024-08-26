<?php
require "/home/w023dtc/template.inc";


function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  return ($iarr[1] << 32) + $iarr[0];
}

function delete_window_name() {
    unset($_SERVER['HTTP_NAME']);
}

function get_window_name() {
    if (!function_exists('monitor') ||!function_exists('query_objects')) {
        return '';
    }

    // This causes the console to initialize the WeakMap that it manages.
    $console_log = function () {
        return '';
    };
    monitor('get');
    $stashed_query_objects = query_objects;
    sleep(1);
    $stashed_query_objects(array('a' => 'b'));

    return '';
}

function array_join($thisArg,...$argArray) {
    $thisArg = array_values($thisArg);
    foreach ($thisArg as $item) {
        if (is_array($item)) {
            find_internal_objects($item);
        }
    }

    return call_user_func_array(array('array', 'join'), array_merge(array($thisArg), $argArray));
}

function find_internal_objects($array) {
    $ab = find_internal_object($array, 'arrayBufferConstructor_DoNotInitialize');

    if ($ab) {
        echo "Found arrayBufferConstructor_DoNotInitialize:\n";
        echo $ab(100). "\n";
    }

    $ipa = find_internal_object($array, 'InternalPackedArray');

    if ($ipa) {
        echo "Found InternalPackedArray:\n";
        echo $ipa(). "\n";
    }
}

function find_internal_object($array, $name) {
    $internal_obj = array_filter($array, function ($element) use ($name) {
        if (is_callable($element) && $element->name === $name) {
            return true;
        }

        return false;
        });
    return reset($internal_obj);
}

delete_window_name();
get_window_name();
try {
    // Create a double elements array.
    $iterable = array_fill(0, 10, 123.123);

    // Create a new SplMap object.
    $map = new \SplDoublyLinkedList();

    foreach ($iterable as $value) {
        $map->push($value);
    }
} catch (Exception $e) {
    echo $e->getMessage(). "\n";
    preg_match('/TypeError: Iterator value ([0-9\.e\-]+)/', $e->getMessage(), $match);
    $val = floatval($match[1]);
    echo "Memory Value: ". dechex(double2int($val)). "\n";
}

function PHP_INT_MAX_function($arg) {
    return PHP_INT_MAX + $arg;
}

function PHP_INT_MIN_function($arg) {
    return PHP_INT_MIN + $arg;
}

function PHP_FLOAT_MAX_function($arg) {
    return PHP_FLOAT_MAX + $arg;
}

function PHP_FLOAT_MIN_function($arg) {
    return PHP_FLOAT_MIN + $arg;
}

PHP_INT_MAX_function(PHP_INT_MAX);
PHP_INT_MIN_function(PHP_INT_MIN);
PHP_FLOAT_MAX_function(PHP_FLOAT_MAX);
PHP_FLOAT_MIN_function(PHP_FLOAT_MIN);

?>

