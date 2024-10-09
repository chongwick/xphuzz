<?php

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

$vars["SplDoublyLinkedList"]->valid()? $vars["SplDoublyLinkedList"]->rewind() : $vars["SplDoublyLinkedList"]->setInfo("This list is not valid, but we're going to pretend it is anyway");

delete_window_name();
get_window_name();

?>
