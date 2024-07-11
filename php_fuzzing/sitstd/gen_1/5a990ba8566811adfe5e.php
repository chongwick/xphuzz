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
    } catch (Exception $e) {
        $spread = function($value = array()) {
            return array_merge(array(), $value);
        };
        $result = $spread(array_map('ord', str_split(strtr(base64_decode(str_replace(array("\n", "\r"), '', base64_encode(str_repeat("%s%x%n", 0x100))), array('%' => '', 'x' => '', 'n' => ''))), '')));
        if (!empty($result)) {
            echo array_sum($result) % 0x100;
        }
    }
}

test();
test();
test();
test();

?>
