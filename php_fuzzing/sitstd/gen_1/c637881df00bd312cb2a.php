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

mb_encode_mimeheader(
    implode(
        array_map(
            function($c) {
                return "\\x". str_pad(dechex($c), 2, "0"). chr(0x1F). chr(0x1E);
            },
            array_merge(range(0, 255), array(0x10000, 0x10001, 0x10002))
        )
    ),
    chr(0x20). str_repeat(chr(0x80), 65). chr(0x7F). str_repeat(chr(0x0), 1025). chr(0x0). str_repeat(chr(0x0), 65537). chr(0x0),
    str_repeat(chr(0x20), 0x100). str_repeat(chr(0x0), 0x100),
    chr(0x20). str_repeat(chr(0x20), 65). chr(0x20). str_repeat(chr(0x0), 65537). chr(0x20). str_repeat(chr(0x20), 65537). chr(0x20),
    chr(0x20). str_repeat(chr(0x20), 65). chr(0x20). str_repeat(chr(0x20), 65537). chr(0x20). str_repeat(chr(0x20), 65537). chr(0x20)
);

?>
