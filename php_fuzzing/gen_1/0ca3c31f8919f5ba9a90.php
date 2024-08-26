<?php
require "/home/w023dtc/template.inc";


// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --allow-natives-syntax --regexp-interpret-all

function assertArrayEquals($expected, $result) {
    if ($expected!== $result) {
        echo "Assertion failed: Expected '$expected', got '$result'". PHP_EOL;
    }
}

$pattern = '/.(?<!^.)(?php echo PHP_INT_MAX;)?/.m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o", PHP_INT_MAX], $match);

$pattern = '/.(?<!\b.)(?php echo PHP_INT_MIN;)?/.m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f", PHP_INT_MIN], $match);

$pattern = '/.(?<!\B.)(?php echo PHP_FLOAT_MAX;)?/.m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f", PHP_FLOAT_MAX], $match);

$pattern = '/.(?<!\B.)(?php echo PHP_FLOAT_MIN;)?/.m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f", PHP_FLOAT_MIN], $match);

$number = 5.0260805378947765e+223;
$nf = number_format($number, 0, '.', '');
echo $nf;

?>
