<?php

function test() {
    $spread = function($value = array()) {
        return array_merge(array(), $value);
    };
    try {
        $result = $spread();
        if (!empty($result)) {
            throw new Exception('Expected an empty array, got '. print_r($result, true));
        }
    } catch (Exception $e) {}
}

test();
test();
test();
test();

?>
