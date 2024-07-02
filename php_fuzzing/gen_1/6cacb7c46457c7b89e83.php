<?php

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --no-use-ic --interrupt-budget=100 --always-osr

$num_iterations = 1000;
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
posix_getgrgid(5473817451);
preg_match($re, 'foo*bar');

?>
