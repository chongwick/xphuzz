<?php
// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

$a = array(); // Initialize $a as an array
$b = array();

$a['length'] = 4294967296; // 2 ^ 32 (max array length + 1)
assertThrows(function() use ($a, $b) {
    array_join($b, array_values($a));
}, 'TypeError: Array to string conversion');

function assertThrows($callable, $expectedExceptionMessage) {
    try {
        $callable();
        throw new Exception("Expected $expectedExceptionMessage but no exception was thrown");
    } catch (Exception $e) {
        if (!strpos($e->getMessage(), $expectedExceptionMessage)) {
            throw new Exception("Expected $expectedExceptionMessage but got ". $e->getMessage());
        }
    }
}

function array_join($array, $glue) {
    $result = '';
    foreach ($array as $value) {
        $result.= $value. $glue;
    }
    return rtrim($result, ''); // Remove the last occurrence of any character
}
?>
