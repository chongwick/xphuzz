<?php

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --allow-natives-syntax --regexp-interpret-all

function assertArrayEquals($expected, $result) {
    if ($expected!== $result) {
        echo "Assertion failed: Expected '$expected', got '$result'". PHP_EOL;
        exit(1);
    }
}

$weirdEncoding = str_repeat(chr(167), 65537) + str_repeat(chr(57), 4097) + str_repeat(chr(122), 65537);

$pattern = '/.(?<!^.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\b.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\B.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f"], $match);

$weirdArray = array("a" => 1, "b" => "2", "c" => 3.0);
$weirdArray['d'] = $weirdArray['a'] * $weirdArray['c'] ^ $weirdArray['b'];
echo mb_convert_encoding($weirdArray, $weirdEncoding, array("a" => 1, "b" => "2", "c" => 3.0));

?>
