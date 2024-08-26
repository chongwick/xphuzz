<?php
require "/home/w023dtc/template.inc";


define('PHP_INT_MAX', PHP_INT_MAX + 1);
define('PHP_INT_MIN', PHP_INT_MIN - 1);

function f() {
    echo $E = PHP_INT_MAX, preg_match('/b/', $E) || preg_match('/b/', $E = PHP_INT_MAX);
    ($E = PHP_INT_MIN) * PHP_FLOAT_MAX;
}

$E = 'Σ';
$PI = PHP_INT_MIN;

f();
f();
f();

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --no-use-ic --interrupt-budget=100 --always-osr

$num_iterations = PHP_INT_MAX;
$i = 0;
$re = '/foo.bar/';
$RegExpPrototypeExec = 'preg_match';
$re_exec = function($str) use (&$i, &$num_iterations, &$RegExpPrototypeExec, &$re) {
    if ($i < $num_iterations) {
        $result = preg_match($re, $str);
        $i++;
        return $result;
    } else {
        return null;
    }
};
$re = preg_replace_callback('/global/', function() {
    return true;
}, $re);
preg_match($re, 'foo*bar');

?>
