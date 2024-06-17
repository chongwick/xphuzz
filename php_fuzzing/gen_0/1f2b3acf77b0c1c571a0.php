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

$pattern = '/.(?<!^.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\b.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\B.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f"], $match);

?>
